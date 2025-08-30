<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MuridRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nisn' => 'required|string|unique:murids,nisn',
            'nis' => 'required|string|unique:murids,nis',
            'nik' => 'required|string|unique:murids,nik',
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
