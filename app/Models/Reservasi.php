<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $fillable = [
        'kode_booking',
        'user_id',
        'fasilitas_id',
        'jadwal_slot_id',
        'unit_kode',
        'unit_nama',
        'tanggal_reservasi',
        'no_whatsapp',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_reservasi' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    public function jadwalSlot()
    {
        return $this->belongsTo(JadwalSlot::class);
    }
}
