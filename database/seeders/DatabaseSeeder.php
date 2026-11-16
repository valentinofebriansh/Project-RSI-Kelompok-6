<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use App\Models\JadwalSlot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Default
        User::updateOrCreate(
            ['email' => 'admin.gamecorner@ub.ac.id'],
            [
                'name' => 'Admin Game Corner',
                'nim' => null,
                'no_whatsapp' => '081234567890',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Admin Kedua (Opsional, pastikan koma di tiap baris aman)
        User::updateOrCreate(
            ['email' => 'abc123@gmail.com'],
            [
                'name' => 'Admin Game Corner 2',
                'nim' => null,
                'no_whatsapp' => '081234567890',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
        
        // 2. Akun Mahasiswa Contoh (untuk testing cepat)
        User::updateOrCreate(
            ['email' => 'kaysannasution@student.ub.ac.id'],
            [
                'name' => 'Kaysan Nawfal Niscal Nasution',
                'nim' => '255150407111082',
                'no_whatsapp' => '082279835502',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'mahasiswa',
            ]
        );

        // 3. Data 3 Fasilitas Game Corner
        Fasilitas::updateOrCreate(
            ['slug' => 'ps-xbox-gedung-f'],
            [
                'nama_fasilitas' => 'Playstation & Xbox Gedung F',
                'kategori' => 'ps',
                'lokasi' => 'Lantai 2 Gedung F FILKOM UB',
                'kapasitas' => 4,
                'deskripsi' => 'Dilengkapi sofa santai, TV 4K HDR, serta ragam koleksi game sports, adventure, dan multiplayer terbaru.',
                'gambar' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=700&q=80',
                'tags' => ['PS5 DualSense', 'Xbox Series X', 'TV 4K 55 Inch', 'Free WiFi UB'],
                'units' => [
                    ['kode' => 'PS-01', 'nama' => 'PlayStation 5', 'populer' => true],
                    ['kode' => 'PS-02', 'nama' => 'PlayStation 5', 'populer' => false],
                    ['kode' => 'XBOX-01', 'nama' => 'Series X', 'populer' => false],
                ],
                'is_populer' => true,
                'status' => 'tersedia',
            ]
        );

        Fasilitas::updateOrCreate(
            ['slug' => 'vr-gedung-f'],
            [
                'nama_fasilitas' => 'Virtual Reality Gedung F',
                'kategori' => 'vr',
                'lokasi' => 'Lantai 2 Gedung F FILKOM UB',
                'kapasitas' => 2,
                'deskripsi' => 'Eksplorasi simulasi interaktif 3D & game metaverse mutakhir dengan sensor pelacak gerak presisi tinggi.',
                'gambar' => 'https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&fit=crop&w=700&q=80',
                'tags' => ['Meta Quest 3', 'HTC Vive Focus', 'Ruang Tracking Luas'],
                'units' => [
                    ['kode' => 'VR-01', 'nama' => 'Meta Quest 3', 'populer' => true],
                    ['kode' => 'VR-02', 'nama' => 'HTC Vive Focus', 'populer' => false],
                ],
                'is_populer' => false,
                'status' => 'tersedia',
            ]
        );

        Fasilitas::updateOrCreate(
            ['slug' => 'pump-it-up-gkm'],
            [
                'nama_fasilitas' => 'Pump It Up GKM',
                'kategori' => 'piu',
                'lokasi' => 'Lantai 1 Gedung GKM UB',
                'kapasitas' => 2,
                'deskripsi' => 'Mesin arcade dance rhythm interaktif dengan playlist K-Pop, EDM, dan lagu.',
                'gambar' => 'https://www.gameroomguys.com/grg-site/item-images/68550_01.jpg',
                'tags' => ['PIU Phoenix 2024', 'Dual Stage Pad', 'Sound System Pro'],
                'units' => [
                    ['kode' => 'PIU-01', 'nama' => 'PIU Phoenix Dual Pad', 'populer' => true],
                ],
                'is_populer' => false,
                'status' => 'tersedia',
            ]
        );

        // 4. Data 8 Sesi Jadwal Harian
        $slots = [
            ['sesi_ke' => 1, 'jam_mulai' => '08:00:00', 'jam_selesai' => '09:00:00', 'label_status' => 'Tersedia', 'is_favorit' => false],
            ['sesi_ke' => 2, 'jam_mulai' => '09:15:00', 'jam_selesai' => '10:15:00', 'label_status' => 'Tersedia', 'is_favorit' => false],
            ['sesi_ke' => 3, 'jam_mulai' => '10:30:00', 'jam_selesai' => '11:30:00', 'label_status' => 'Tersedia', 'is_favorit' => false],
            ['sesi_ke' => 4, 'jam_mulai' => '11:45:00', 'jam_selesai' => '12:45:00', 'label_status' => 'Tersedia', 'is_favorit' => false],
            ['sesi_ke' => 5, 'jam_mulai' => '13:00:00', 'jam_selesai' => '14:00:00', 'label_status' => 'Slot Populer', 'is_favorit' => true],
            ['sesi_ke' => 6, 'jam_mulai' => '14:15:00', 'jam_selesai' => '15:15:00', 'label_status' => 'Tersedia', 'is_favorit' => false],
            ['sesi_ke' => 7, 'jam_mulai' => '15:30:00', 'jam_selesai' => '16:30:00', 'label_status' => 'Tersedia', 'is_favorit' => false],
            ['sesi_ke' => 8, 'jam_mulai' => '16:45:00', 'jam_selesai' => '17:45:00', 'label_status' => 'Sesi Terakhir', 'is_favorit' => false],
        ];

        foreach ($slots as $slot) {
            JadwalSlot::updateOrCreate(
                ['sesi_ke' => $slot['sesi_ke']],
                $slot
            );
        }
    }
}