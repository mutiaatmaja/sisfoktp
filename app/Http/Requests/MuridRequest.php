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
        $id = $this->route('murid')?->id;
        return [
            'nisn' => 'required|string|unique:murids,nisn' . ($id ? ',' . $id : ''),
            'nis' => 'required|string|unique:murids,nis' . ($id ? ',' . $id : ''),
            'nik' => 'required|string|unique:murids,nik' . ($id ? ',' . $id : ''),
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
