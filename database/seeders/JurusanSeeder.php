<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            ['kode' => 'PPLG', 'nama' => 'Pengembangan Perangkat Lunak dan Gim'],
            ['kode' => 'TJKT', 'nama' => 'Teknik Jaringan Komputer dan Gim'],
            ['kode' => 'DKV', 'nama' => 'Desain Komunikasi Visual'],
            ['kode' => 'AK', 'nama' => 'Akuntansi'],
            ['kode' => 'TO', 'nama' => 'Teknik Otomotif'],
            ['kode' => 'TPFL', 'nama' => 'Teknik Pengelasan dan Fabrikasi Logam'],
        ];
        foreach ($jurusans as $jurusan) {
            \App\Models\Jurusan::create($jurusan);
        }
    }
}
