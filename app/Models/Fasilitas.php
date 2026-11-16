<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    protected $fillable = [
        'nama_fasilitas',
        'slug',
        'kategori',
        'lokasi',
        'kapasitas',
        'deskripsi',
        'gambar',
        'tags',
        'units',
        'is_populer',
        'status',
    ];

    protected $casts = [
        'tags' => 'array',
        'units' => 'array',
        'is_populer' => 'boolean',
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}