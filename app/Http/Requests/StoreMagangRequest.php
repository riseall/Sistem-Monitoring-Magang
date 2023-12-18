<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMagangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nim' => 'required|exists:mahasiswa,nim',
            'nama_mahasiswa' => 'required|string|max:100',
            'kelas' => 'required|string|max:25',
            'nama_perusahaan' => 'required|string|max:100',
            'tanggal_magang' => 'required|date',
            'judul_laporan' => 'required|string|max:200',
            'dosen_pembimbing' => 'required|string|max:100',
            'alamat_perusahaan' => 'required|string|max:255',
            'telepon_perusahaan' => 'required|string|max:100',
            'keterangan' => 'required|string',
        ];
    }
}
