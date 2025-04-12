<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'uni_id',
        'dept_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'gender',
        'date_of_birth',
        'cgpa',
        'graduation_status'
    ];
    

    
protected $casts = [
    'date_of_birth' => 'date',
    // other casts...
];

    public function department()
    {
        return $this->belongsTo(Departments::class, 'dept_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id');
    }

    public function scholarship()
    {
        return $this->hasOne(Scholarships::class, 'student_id', 'student_id');
    }

    public function courses()
{
    return $this->belongsToMany(Courses::class, 'enrollment', 'student_id', 'course_id')
                ->withPivot('semester', 'year', 'grade')
                ->withTimestamps();
}

}
