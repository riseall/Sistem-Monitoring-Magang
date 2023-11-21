<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMagangRequest extends FormRequest
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
            'nim' => 'sometimes|exists:mahasiswa,nim',
            'nama_mahasiswa' => 'sometimes|string|max:100',
            'kelas' => 'sometimes|string|max:25',
            'nama_perusahaan' => 'sometimes|string|max:100',
            'tanggal_magang' => 'sometimes|date',
            'judul_laporan' => 'sometimes|string|max:200',
            'dosen_pembimbing' => 'sometimes|string|max:100',
            'alamat_perusahaan' => 'sometimes|string|max:255',
            'telepon_perusahaan' => 'sometimes|string|max:100',
            'keterangan' => 'sometimes|string',
        ];
    }
}
