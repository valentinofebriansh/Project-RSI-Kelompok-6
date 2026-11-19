<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\JadwalSlot;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $fasilitas = Fasilitas::where('status', 'tersedia')->get();

        $tiketAktif = Reservasi::with(['fasilitas', 'jadwalSlot'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'disetujui'])
            ->whereDate('tanggal_reservasi', '>=', now()->toDateString())
            ->orderBy('tanggal_reservasi')
            ->get();

        $latestReservasi = Reservasi::with(['fasilitas', 'jadwalSlot'])
            ->where('user_id', $user->id)
            ->whereDate('tanggal_reservasi', '>=', now()->toDateString())
            ->whereIn('status', ['pending', 'disetujui', 'ditolak'])
            ->latest('id')
            ->first();

        $bookingTerakhir = $latestReservasi;

        return view('mahasiswa.dashboard', compact('user', 'fasilitas', 'tiketAktif', 'latestReservasi', 'bookingTerakhir'));
    }

    public function pilihUnit(Request $request)
    {
        $fasilitas = $request->filled('fasilitas_id')
            ? Fasilitas::findOrFail($request->fasilitas_id)
            : Fasilitas::firstOrFail();

        $tanggal = $request->input('tanggal', now()->toDateString());
        $totalSlotAktif = JadwalSlot::where('is_aktif', true)->count();

        // Hitung jumlah slot terisi per unit_kode pada tanggal tersebut agar status VR & PS tidak saling nyantol
        $bookingPerUnit = Reservasi::where('fasilitas_id', $fasilitas->id)
            ->whereDate('tanggal_reservasi', $tanggal)
            ->whereIn('status', ['pending', 'disetujui'])
            ->selectRaw('unit_kode, COUNT(*) as total_terisi')
            ->groupBy('unit_kode')
            ->pluck('total_terisi', 'unit_kode')
            ->toArray();

        $unitsStatus = [];
        foreach ($fasilitas->units ?? [] as $u) {
            $kode = $u['kode'];
            $terisi = $bookingPerUnit[$kode] ?? 0;
            $sisaSlot = max(0, $totalSlotAktif - $terisi);

            $unitsStatus[$kode] = [
                'terisi' => $terisi,
                'sisa_slot' => $sisaSlot,
                'is_penuh' => ($totalSlotAktif > 0 && $sisaSlot === 0),
            ];
        }

        return view('mahasiswa.pilih_unit', compact('fasilitas', 'unitsStatus', 'tanggal'));
    }

    public function pilihJadwal(Request $request)
    {
        $fasilitas = $request->filled('fasilitas_id')
            ? Fasilitas::findOrFail($request->fasilitas_id)
            : Fasilitas::firstOrFail();

        $units = collect($fasilitas->units ?? []);
        $requestedKode = $request->input('unit_kode');

        $selectedUnit = $units->firstWhere('kode', $requestedKode)
            ?? $units->first()
            ?? ['kode' => 'PS-01', 'nama' => 'PlayStation 5'];

        $unit_kode = $selectedUnit['kode'];
        $unit_nama = $request->input('unit_nama', $selectedUnit['nama']);
        $tanggal = $request->input('tanggal', now()->toDateString());

        $jadwalSlots = JadwalSlot::where('is_aktif', true)->orderBy('sesi_ke')->get();

        // Filter ketat HANYA untuk unit_kode yang dipilih
        $bookedSlotIds = Reservasi::where('fasilitas_id', $fasilitas->id)
            ->where('unit_kode', $unit_kode)
            ->whereDate('tanggal_reservasi', $tanggal)
            ->whereIn('status', ['pending', 'disetujui'])
            ->pluck('jadwal_slot_id')
            ->toArray();

        $pastSlotIds = [];
        if ($tanggal === now()->toDateString()) {
            $currentWibTime = now()->format('H:i:s');
            $pastSlotIds = $jadwalSlots->filter(function ($slot) use ($currentWibTime) {
                return $slot->jam_selesai <= $currentWibTime;
            })->pluck('id')->toArray();
        }

        $unitKode = $unit_kode;
        $unitNama = $unit_nama;

        return view('mahasiswa.pilih_jadwal', compact(
            'fasilitas',
            'unit_kode',
            'unit_nama',
            'unitKode',
            'unitNama',
            'tanggal',
            'jadwalSlots',
            'bookedSlotIds',
            'pastSlotIds'
        ));
    }

    public function konfirmasi(Request $request)
    {
        $user = Auth::user();
        $fasilitas = $request->filled('fasilitas_id')
            ? Fasilitas::findOrFail($request->fasilitas_id)
            : Fasilitas::firstOrFail();

        $slot = $request->filled('jadwal_slot_id')
            ? JadwalSlot::findOrFail($request->jadwal_slot_id)
            : JadwalSlot::firstOrFail();

        $unit_kode = $request->input('unit_kode', 'PS-01');
        $unit_nama = $request->input('unit_nama', 'PlayStation 5');
        $tanggal = $request->input('tanggal', now()->toDateString());

        $jadwalSlot = $slot;
        $unitKode = $unit_kode;
        $unitNama = $unit_nama;

        return view('mahasiswa.konfirmasi', compact(
            'user',
            'fasilitas',
            'slot',
            'jadwalSlot',
            'unit_kode',
            'unit_nama',
            'unitKode',
            'unitNama',
            'tanggal'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas,id',
            'jadwal_slot_id' => 'required|exists:jadwal_slots,id',
            'unit_kode' => 'required|string|max:50',
            'unit_nama' => 'required|string|max:100',
            'tanggal_reservasi' => 'required|date',
            'whatsapp' => 'required|string|max:25',
            'agreement' => 'accepted',
        ]);

        $user = Auth::user();

        $sudahBookingHariIni = Reservasi::where('user_id', $user->id)
            ->whereDate('tanggal_reservasi', $validated['tanggal_reservasi'])
            ->whereIn('status', ['pending', 'disetujui', 'selesai'])
            ->exists();

        if ($sudahBookingHariIni) {
            return back()->withErrors([
                'booking' => 'Kuota habis! Kamu sudah memiliki reservasi aktif pada tanggal tersebut (maksimal 1 sesi per hari).',
            ]);
        }

        $slotTerisi = Reservasi::where('fasilitas_id', $validated['fasilitas_id'])
            ->where('unit_kode', $validated['unit_kode'])
            ->whereDate('tanggal_reservasi', $validated['tanggal_reservasi'])
            ->where('jadwal_slot_id', $validated['jadwal_slot_id'])
            ->whereIn('status', ['pending', 'disetujui'])
            ->exists();

        if ($slotTerisi) {
            return back()->withErrors([
                'booking' => 'Maaf, slot jadwal untuk unit ini baru saja dipesan mahasiswa lain.',
            ]);
        }

        $user->update(['no_whatsapp' => $validated['whatsapp']]);

        Reservasi::create([
            'kode_booking' => 'BK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4)),
            'user_id' => $user->id,
            'fasilitas_id' => $validated['fasilitas_id'],
            'jadwal_slot_id' => $validated['jadwal_slot_id'],
            'unit_kode' => $validated['unit_kode'],
            'unit_nama' => $validated['unit_nama'],
            'tanggal_reservasi' => $validated['tanggal_reservasi'],
            'no_whatsapp' => $validated['whatsapp'],
            'status' => 'pending',
        ]);

        return redirect()->route('mahasiswa.dashboard')
            ->with('success', 'Pengajuan reservasi berhasil dikirim! Menunggu persetujuan admin.');
    }
}