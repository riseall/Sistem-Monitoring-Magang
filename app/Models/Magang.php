<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Magang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mahasiswa';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_mahasiswa',
        'nim',
        'kelas',
        'nama_perusahaan',
        'tanggal_magang',
        'judul_laporan',
        'dosen_pembimbing',
        'telepon_perusahaan',
        'alamat_perusahaan',
        'keterangan',
    ];
}
