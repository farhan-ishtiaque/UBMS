<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyRecruitment extends Model
{
    protected $primaryKey = 'recruitment_id';

    protected $fillable = [
        'uni_id','job_id',  'recruitment_status','first_name', 'middle_name', 'last_name',
        'designation','email', 'qualification', 'teaching_experience','dept_id'
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPostings::class, 'job_id');
    }

}
