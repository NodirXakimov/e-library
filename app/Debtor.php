<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class Debtor extends Model
{
    protected $fillable = [
        'student_id', 'book_id', 'expiration_date'
    ];
    /**
     * Get the book that owns the Debtor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Get the student that owns the Debtor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
