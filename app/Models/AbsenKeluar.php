<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbsenKeluar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "absen_keluar";
    protected $fillable = [
        "foto_out",
        "hari_out",
        "tanggal_out",
        "waktu_out",
        "lokasi_out",
    ];
}
