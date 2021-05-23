<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'student_id', 'qr_code', 'name', 'publisher_year', 'author', 'publisher_name'
    ];
}
