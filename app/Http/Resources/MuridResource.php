<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MuridResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'nisn' => $this->nisn,
            'nis' => $this->nis,
            'nik' => $this->nik,
            'nama' => $this->nama,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'kelas' => $this->kelas ? [
                'id' => $this->kelas->id,
                'nama' => $this->kelas->nama,
            ] : null,
            'jurusan' => $this->jurusan ? [
                'id' => $this->jurusan->id,
                'kode' => $this->jurusan->kode,
                'nama' => $this->jurusan->nama,
            ] : null,
            'foto' => $this->foto,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
