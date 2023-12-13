<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbsenKeluar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "absen_keluar";

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'mahasiswa_id',
        "foto_out",
        "hari_out",
        "tanggal_out",
        "waktu_out",
        "lokasi_out",
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
