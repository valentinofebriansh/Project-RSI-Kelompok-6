<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LogOperasional extends Model
{
    protected $fillable = ['admin_id', 'aktivitas', 'detail'];
}