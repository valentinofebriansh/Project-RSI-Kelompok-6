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
        Schema::create('jadwal_slots', function (Blueprint $table) {
            $table->id();
            $table->integer('sesi_ke');        // 1 sampai 8
            $table->time('jam_mulai');         // Contoh: 13:00:00
            $table->time('jam_selesai');       // Contoh: 14:00:00
            $table->string('label_status')->default('Tersedia');
            $table->boolean('is_favorit')->default(false);
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_slots');
    }
};
