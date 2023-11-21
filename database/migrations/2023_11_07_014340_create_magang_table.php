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
        Schema::create('magang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nim')->constrained('mahasiswa')->onDelete('cascade');
            $table->string('nama_mahasiswa');
            $table->string('kelas');
            $table->string('nama_perusahaan');
            $table->date('tanggal_magang');
            $table->string('judul_laporan');
            $table->string('dosen_pembimbing');
            $table->string('alamat_perusahaan');
            $table->string('telepon_perusahaan');
            $table->string('email_perusahaan');
            $table->string('keterangan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magang');
    }
};
