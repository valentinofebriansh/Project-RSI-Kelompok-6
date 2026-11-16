<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique(); // Contoh: BK-20261116-001
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('fasilitas_id')->constrained('fasilitas')->onDelete('cascade');
            $table->foreignId('jadwal_slot_id')->constrained('jadwal_slots')->onDelete('cascade');
            $table->string('unit_kode');              // Contoh: PS-01
            $table->string('unit_nama');              // Contoh: PlayStation 5
            $table->date('tanggal_reservasi');
            $table->string('no_whatsapp');
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'selesai', 'dibatalkan'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
