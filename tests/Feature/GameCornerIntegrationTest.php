<?php

namespace Tests\Feature;

use App\Models\Fasilitas;
use App\Models\JadwalSlot;
use App\Models\LogOperasional;
use App\Models\Notifikasi;
use App\Models\Reservasi;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameCornerIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_timezone_and_locale_configuration(): void
    {
        $this->assertEquals('Asia/Jakarta', config('app.timezone'));
        $this->assertEquals('id', config('app.locale'));
    }

    public function test_guests_and_role_redirection(): void
    {
        // 1. Guest to /admin redirects to admin.login
        $response = $this->get('/admin');
        $response->assertRedirect(route('admin.login'));

        // 2. Guest to /admin/approval redirects to admin.login
        $response = $this->get('/admin/approval');
        $response->assertRedirect(route('admin.login'));

        // 3. Guest to /mahasiswa/dashboard redirects to login
        $response = $this->get('/mahasiswa/dashboard');
        $response->assertRedirect(route('login'));

        // 4. Mahasiswa accessing /admin/approval redirects to mahasiswa.dashboard
        $mahasiswa = User::where('role', 'mahasiswa')->first();
        $response = $this->actingAs($mahasiswa)->get('/admin/approval');
        $response->assertRedirect(route('mahasiswa.dashboard'));

        // 5. Admin accessing /mahasiswa/dashboard redirects to admin.approval
        $admin = User::where('role', 'admin')->first();
        $response = $this->actingAs($admin)->get('/mahasiswa/dashboard');
        $response->assertRedirect(route('admin.approval'));
    }

    public function test_mahasiswa_dashboard_3_status_cards(): void
    {
        $mahasiswa = User::where('role', 'mahasiswa')->first();
        $fasilitas = Fasilitas::first();
        $slot = JadwalSlot::first();

        // 1. Belum ada reservasi
        $response = $this->actingAs($mahasiswa)->get(route('mahasiswa.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Belum ada reservasi');

        // 2. Status PENDING
        $reservasi = Reservasi::create([
            'kode_booking' => 'BK-20261117-001',
            'user_id' => $mahasiswa->id,
            'fasilitas_id' => $fasilitas->id,
            'jadwal_slot_id' => $slot->id,
            'unit_kode' => 'PS-01',
            'unit_nama' => 'PlayStation 5',
            'tanggal_reservasi' => now()->toDateString(),
            'no_whatsapp' => '+6282279835502',
            'status' => 'pending',
        ]);

        $resPending = $this->actingAs($mahasiswa)->get(route('mahasiswa.dashboard'));
        $resPending->assertSee('PENDING (Menunggu Persetujuan)');
        $resPending->assertSee('#22C55E');

        // 3. Status DISETUJUI
        $reservasi->update(['status' => 'disetujui']);
        $resApproved = $this->actingAs($mahasiswa)->get(route('mahasiswa.dashboard'));
        $resApproved->assertSee('DISETUJUI');

        // 4. Status DITOLAK
        $reservasi->update(['status' => 'ditolak']);
        $resRejected = $this->actingAs($mahasiswa)->get(route('mahasiswa.dashboard'));
        $resRejected->assertSee('DITOLAK');
        $resRejected->assertSee('#EF4444');
    }

    public function test_mahasiswa_booking_flow_views(): void
    {
        $mahasiswa = User::where('role', 'mahasiswa')->first();
        $fasilitas = Fasilitas::first();
        $slot = JadwalSlot::first();

        // 1. Dashboard
        $response = $this->actingAs($mahasiswa)->get(route('mahasiswa.dashboard'));
        $response->assertStatus(200);
        $response->assertSee($fasilitas->nama_fasilitas);

        // 2. Pilih Unit
        $response = $this->actingAs($mahasiswa)->get(route('mahasiswa.pilih_unit', ['fasilitas_id' => $fasilitas->id]));
        $response->assertStatus(200);
        $response->assertSee($fasilitas->nama_fasilitas);

        // 3. Pilih Jadwal
        $response = $this->actingAs($mahasiswa)->get(route('mahasiswa.pilih_jadwal', [
            'fasilitas_id' => $fasilitas->id,
            'unit_kode' => 'PS-01',
            'unit_nama' => 'PlayStation 5',
            'tanggal' => now()->toDateString(),
        ]));
        $response->assertStatus(200);
        $response->assertSee('PS-01');

        // 4. Konfirmasi
        $response = $this->actingAs($mahasiswa)->get(route('mahasiswa.konfirmasi', [
            'fasilitas_id' => $fasilitas->id,
            'unit_kode' => 'PS-01',
            'unit_nama' => 'PlayStation 5',
            'tanggal' => now()->toDateString(),
            'jadwal_slot_id' => $slot->id,
        ]));
        $response->assertStatus(200);
        $response->assertSee($mahasiswa->name);
        $response->assertSee($mahasiswa->nim);
    }

    public function test_mahasiswa_successful_booking_and_limits(): void
    {
        $mahasiswa = User::where('role', 'mahasiswa')->first();
        $fasilitas = Fasilitas::first();
        $slot = JadwalSlot::first();
        $tanggal = now()->toDateString();

        // Booking pertama berhasil
        $response = $this->actingAs($mahasiswa)->post(route('mahasiswa.booking.store'), [
            'fasilitas_id' => $fasilitas->id,
            'jadwal_slot_id' => $slot->id,
            'unit_kode' => 'PS-01',
            'unit_nama' => 'PlayStation 5',
            'tanggal_reservasi' => $tanggal,
            'whatsapp' => '082279835502',
            'agreement' => '1',
        ]);

        $response->assertRedirect(route('mahasiswa.dashboard'));
        $this->assertDatabaseHas('reservasis', [
            'user_id' => $mahasiswa->id,
            'unit_kode' => 'PS-01',
            'tanggal_reservasi' => $tanggal,
            'status' => 'pending',
        ]);

        // Booking kedua pada hari yang sama oleh mahasiswa yang sama harus ditolak (kuota 1x per hari)
        $anotherSlot = JadwalSlot::where('id', '!=', $slot->id)->first();
        $response2 = $this->actingAs($mahasiswa)->post(route('mahasiswa.booking.store'), [
            'fasilitas_id' => $fasilitas->id,
            'jadwal_slot_id' => $anotherSlot->id,
            'unit_kode' => 'PS-02',
            'unit_nama' => 'PlayStation 5',
            'tanggal_reservasi' => $tanggal,
            'whatsapp' => '082279835502',
            'agreement' => '1',
        ]);

        $response2->assertSessionHasErrors('booking');

        // Mahasiswa lain mencoba booking slot & unit yang sama pada hari yang sama harus ditolak (bentrok)
        $anotherMahasiswa = User::create([
            'name' => 'Budi Santoso',
            'nim' => '255150400000001',
            'email' => 'budi@student.ub.ac.id',
            'no_whatsapp' => '081299998888',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);

        $response3 = $this->actingAs($anotherMahasiswa)->post(route('mahasiswa.booking.store'), [
            'fasilitas_id' => $fasilitas->id,
            'jadwal_slot_id' => $slot->id,
            'unit_kode' => 'PS-01',
            'unit_nama' => 'PlayStation 5',
            'tanggal_reservasi' => $tanggal,
            'whatsapp' => '081299998888',
            'agreement' => '1',
        ]);

        $response3->assertSessionHasErrors('booking');
    }

    public function test_admin_approval_and_rejection(): void
    {
        $admin = User::where('role', 'admin')->first();
        $mahasiswa = User::where('role', 'mahasiswa')->first();
        $fasilitas = Fasilitas::first();
        $slots = JadwalSlot::take(2)->get();

        $reservasi1 = Reservasi::create([
            'kode_booking' => 'BK-20261117-001',
            'user_id' => $mahasiswa->id,
            'fasilitas_id' => $fasilitas->id,
            'jadwal_slot_id' => $slots[0]->id,
            'unit_kode' => 'PS-01',
            'unit_nama' => 'PlayStation 5',
            'tanggal_reservasi' => now()->toDateString(),
            'no_whatsapp' => '+6282279835502',
            'status' => 'pending',
        ]);

        $reservasi2 = Reservasi::create([
            'kode_booking' => 'BK-20261117-002',
            'user_id' => $mahasiswa->id,
            'fasilitas_id' => $fasilitas->id,
            'jadwal_slot_id' => $slots[1]->id,
            'unit_kode' => 'PS-02',
            'unit_nama' => 'PlayStation 5',
            'tanggal_reservasi' => now()->addDay()->toDateString(),
            'no_whatsapp' => '+6282279835502',
            'status' => 'pending',
        ]);

        // Halaman Approval menampilkan data
        $response = $this->actingAs($admin)->get(route('admin.approval'));
        $response->assertStatus(200);
        $response->assertSee('PS-01');
        $response->assertSee('PS-02');
        $response->assertSee('2 Pengajuan');

        // Approve Reservasi 1
        $responseApprove = $this->actingAs($admin)->post(route('admin.approval.approve', $reservasi1->id));
        $responseApprove->assertRedirect(route('admin.approval'));
        $this->assertEquals('disetujui', $reservasi1->fresh()->status);
        $this->assertDatabaseHas('log_operasionals', [
            'admin_id' => $admin->id,
            'aktivitas' => 'Approval Reservasi',
        ]);
        $this->assertDatabaseHas('notifikasis', [
            'user_id' => $mahasiswa->id,
            'judul' => 'Reservasi Disetujui',
        ]);

        // Reject Reservasi 2
        $responseReject = $this->actingAs($admin)->post(route('admin.approval.reject', $reservasi2->id));
        $responseReject->assertRedirect(route('admin.approval'));
        $this->assertEquals('ditolak', $reservasi2->fresh()->status);
        $this->assertDatabaseHas('log_operasionals', [
            'admin_id' => $admin->id,
            'aktivitas' => 'Penolakan Reservasi',
        ]);
        $this->assertDatabaseHas('notifikasis', [
            'user_id' => $mahasiswa->id,
            'judul' => 'Reservasi Ditolak',
        ]);
    }

    public function test_admin_history_and_export_xlsx(): void
    {
        $admin = User::where('role', 'admin')->first();
        $mahasiswa = User::where('role', 'mahasiswa')->first();
        $fasilitas = Fasilitas::first();
        $slot = JadwalSlot::first();

        $reservasi = Reservasi::create([
            'kode_booking' => 'BK-20261117-099',
            'user_id' => $mahasiswa->id,
            'fasilitas_id' => $fasilitas->id,
            'jadwal_slot_id' => $slot->id,
            'unit_kode' => 'PS-01',
            'unit_nama' => 'PlayStation 5',
            'tanggal_reservasi' => now()->toDateString(),
            'no_whatsapp' => '+6282279835502',
            'status' => 'disetujui',
        ]);

        // 1. History view
        $responseHistory = $this->actingAs($admin)->get(route('admin.history', [
            'bulan' => now()->month,
            'tahun' => now()->year,
        ]));
        $responseHistory->assertStatus(200);
        $responseHistory->assertSee('PS-01');
        $responseHistory->assertSee('btnDownloadXlsx');

        // 2. Export XLSX
        $responseExport = $this->actingAs($admin)->get(route('admin.history.export', [
            'tanggal' => now()->toDateString(),
        ]));
        $responseExport->assertStatus(200);
        $responseExport->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $responseExport->assertHeader('Content-Disposition', 'attachment; filename="Rekap_Reservasi_' . now()->toDateString() . '.xlsx"');

        // Check valid zip/xlsx archive
        $content = $responseExport->getContent();
        $temp = tempnam(sys_get_temp_dir(), 'test_dl_');
        file_put_contents($temp, $content);
        $zip = new \ZipArchive();
        $this->assertTrue($zip->open($temp));
        $this->assertNotEmpty($zip->getFromName('xl/worksheets/sheet1.xml'));
        $zip->close();
        @unlink($temp);
    }
}
