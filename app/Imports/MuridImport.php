<?php

namespace App\Imports;

use App\Models\Murid;
use Maatwebsite\Excel\Concerns\ToModel;

class MuridImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $jurusan = \App\Models\Jurusan::where('kode', $row[8])->first();
        $kelas = \App\Models\Kelas::where('nama', $row[7])->first();
        return new Murid([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'nisn' => $row[0],
            'nis' => $row[1],
            'nik' => $row[2],
            'nama' => $row[3],
            'tempat_lahir' => $row[4],
            'tanggal_lahir' => $row[5],
            'jenis_kelamin' => $row[6],
            'kelas_id' => $kelas ? $kelas->id : null,
            'jurusan_id' => $jurusan ? $jurusan->id : null,
            // 'foto' => null, // foto diupload manual
        ]);
    }
}
