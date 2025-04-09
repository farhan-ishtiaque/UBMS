<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPostings extends Model
{
    protected $primaryKey = 'job_id';

    protected $fillable = [
        'uni_id', 'dept_id', 'job_title', 'job_type',
        'requirements', 'application_start_date', 'application_deadline'
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id');
    }

    public function department()
    {
        return $this->belongsTo(Departments::class, 'dept_id');
    }

    public function recruitments()
    {
        return $this->hasMany(FacultyRecruitment::class, 'job_id');
    }
}
