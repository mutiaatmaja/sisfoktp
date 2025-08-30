<?php

namespace App\Exports;

use App\Models\Murid;
use Maatwebsite\Excel\Concerns\FromCollection;

class MuridExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Murid::all();
    }
}
