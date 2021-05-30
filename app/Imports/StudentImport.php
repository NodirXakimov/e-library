<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'firstname'     => $row[1],
            'lastname'      => $row[2],
            'middlename'    => $row[3],
            'email'         => $row[4],
            'group'         => $row[5],
            'course'        => $row[6],
            'phone_number'  => $row[7],
            'password'      => Hash::make($row[8]),
        ]);
    }
}
