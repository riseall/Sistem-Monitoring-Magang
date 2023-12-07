<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsenKeluarRequest extends FormRequest
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
            'mahasiswa_id' => 'required|exists:users,id',
            'foto_out' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'hari_out' => 'required',
            'tanggal_out' => 'required',
            'waktu_out' => 'required',
            'lokasi_out' => 'required'
        ];
    }
}
