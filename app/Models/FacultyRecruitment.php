<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyRecruitment extends Model
{
    protected $primaryKey = 'recruitment_id';

    protected $fillable = [
        'job_id',  'recruitment_status','first_name', 'middle_name', 'last_name',
        'designation','email', 'qualification', 'teaching_experience'
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPostings::class, 'job_id');
    }

    public function faculties()
    {
        return $this->belongsToMany(Faculties::class, 'faculty_faculty_recruitment');
    }
}
