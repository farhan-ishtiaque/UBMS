<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarships extends Model
{
    protected $primaryKey = 'scholarship_id';
    protected $fillable = [
        'student_id',
        'scholarship_type',
        'status',
        'amount',
        'start_date',
        'end_date'
    ];

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id', 'student_id');
    }
}