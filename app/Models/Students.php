<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'dept_id', 'uni_id', 'first_name', 'middle_name', 'last_name',
        'gender', 'date_of_birth', 'cgpa', 'graduation_status', 'graduation_date'
    ];

    public function phones()
    {
        return $this->hasMany(StudentPhone::class);
    }


    public function department()
    {
        return $this->belongsTo(Departments::class, 'dept_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id');
    }

    public function scholarships()
    {
        return $this->belongsToMany(StudentScholarship::class, 'stud_scholarship')
                    ->withPivot('application_date', 'disbursement_date', 'percentage', 'status');
    }

    public function courses()
    {
        return $this->belongsToMany(Courses::class, 'enrollment')
                    ->withPivot('attendance', 'grade', 'semester', 'year');
    }
}
