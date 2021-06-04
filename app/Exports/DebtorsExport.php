<?php

namespace App\Exports;

use App\Debtor;
use Maatwebsite\Excel\Concerns\FromCollection;

class DebtorsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Debtor::all();
    }
}
