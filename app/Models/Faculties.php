<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculties extends Model
{
    protected $primaryKey = 'faculty_id';

    protected $fillable = [
        'dept_id', 'uni_id', 'first_name', 'middle_name', 'last_name',
        'designation', 'qualification', 'teaching_experience'
    ];

    public function department()
    {
        return $this->belongsTo(Departments::class, 'dept_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id');
    }

    public function recruitments()
    {
        return $this->belongsToMany(FacultyRecruitment::class, 'faculty_faculty_recruitment');
    }

    public function developmentPrograms()
    {
        return $this->belongsToMany(FacultyDevelopment::class, 'faculty_development_faculty');
    }

    public function phones()
    {
        return $this->hasMany(FacultyPhone::class);
    }

}
