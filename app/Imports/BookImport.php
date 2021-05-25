<?php

namespace App\Imports;

use App\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class BookImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            'name'           => $row[1],
            'author'         => $row[2],
            'published_year' => $row[3],
            'publisher_name' => $row[4],
            'qr_code'        => Str::random(20),
        ]);
    }
}
