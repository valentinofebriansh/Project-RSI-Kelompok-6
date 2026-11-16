<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalSlot extends Model
{
    protected $fillable = [
        'sesi_ke',
        'jam_mulai',
        'jam_selesai',
        'label_status',
        'is_favorit',
        'is_aktif',
    ];

    protected $casts = [
        'is_favorit' => 'boolean',
        'is_aktif' => 'boolean',
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}