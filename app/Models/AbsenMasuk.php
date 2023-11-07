<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbsenMasuk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "absen_masuk";
    protected $fillable = [
        "foto",
        "hari",
        "tanggal",
        "waktu",
        "lokasi",
    ];
}
