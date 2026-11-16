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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fasilitas'); // Contoh: Playstation & Xbox Gedung F
            $table->string('slug')->unique();   // Contoh: ps-xbox-gedung-f
            $table->string('kategori');       // ps, xbox, vr, piu
            $table->string('lokasi');         // Contoh: Lantai 2 Gedung F FILKOM UB
            $table->integer('kapasitas')->default(4);
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->json('tags')->nullable();
            $table->json('units')->nullable();
            $table->boolean('is_populer')->default(false);
            $table->enum('status', ['tersedia', 'maintenance'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
