<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = ['periode', 'total_reservasi', 'file_rekap'];
}
