<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    protected $fillable = [
        'uuid',
        'nisn',
        'nis',
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kelas_id',
        'jurusan_id',
        'foto',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
