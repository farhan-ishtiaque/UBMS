<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculties extends Model
{
    protected $primaryKey = 'faculty_id';
    protected $fillable = [
        'dept_id', 'uni_id', 'first_name', 'middle_name', 'last_name',
        'designation', 'email', 'qualification', 'teaching_experience'
    ];

    public function department()
    {
        return $this->belongsTo(Departments::class, 'dept_id', 'dept_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id', 'uni_id');
    }

    public function phoneNumbers()
    {
        return $this->hasMany(FacultyPhone::class, 'faculty_id', 'faculty_id');
    }

    // Alias for phoneNumbers
    public function phones()
    {
        return $this->phoneNumbers();
    }

    public function recruitments()
    {
        return $this->belongsToMany(FacultyRecruitment::class, 'faculty_faculty_recruitment', 
                                   'faculty_id', 'recruitment_id');
    }

    public function developmentPrograms()
    {
        return $this->belongsToMany(FacultyDevelopment::class, 'faculty_development_faculty',
                                   'faculty_id', 'program_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Courses::class, 'course_faculty', 'faculty_id', 'course_id')
                   ->withPivot(['semester', 'is_primary_instructor'])
                   ->withTimestamps();
    }
}