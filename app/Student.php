<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'middlename', 'email', 'group', 'course', 'phone_number', 'image', 'password'
    ];

   /**
    * Get all of the debts for the Student
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function debts()
   {
       return $this->hasMany(Debtor::class, 'student_id');
   }
   /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

}
