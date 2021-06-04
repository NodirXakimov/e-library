<?php

namespace App\Exports;

use App\Debtor;
use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DebtorsExportView implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $students = Student::has('debts')->with('debts')->get();
        return view('excel.export_debtors', ['students'=> $students]);
    }
}
