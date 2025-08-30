<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasNames = [
            'X AKL.A','X AKL.B','X DKV.A','X DKV.B','X PPLG.A','X PPLG.B','X TJKT.A','X TJKT.B','X TO','X TPFL'
        ];
        foreach ($kelasNames as $nama) {
            \App\Models\Kelas::firstOrCreate(['nama' => $nama]);
        }
    }
}
