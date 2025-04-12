<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $primaryKey = 'course_id';

    protected $fillable = [
        'dept_id',
        'course_name',
        'course_code',
        'credits'
    ];

    public function department()
    {
        return $this->belongsTo(Departments::class, 'dept_id');
    }

    public function students()
    {
        return $this->belongsToMany(Students::class, 'enrollment', 'course_id', 'student_id')
                    ->withPivot('semester', 'year', 'grade')
                    ->withTimestamps();
    }
 
public function faculties()
{
    return $this->belongsToMany(Faculty::class, 'course_faculty')
                ->withPivot(['semester', 'is_primary_instructor'])
                ->withTimestamps();
}
}
