<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'middlename', 'email', 'group', 'course', 'phone_number'
    ];

   /**
    * Get all of the debts for the Student
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function debts(): HasMany
   {
       return $this->hasMany(Debtor::class, 'student_id');
   }
}
