<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'address', 'city', 'pin_code', 'country'];

    protected $table = 'customers';
}
