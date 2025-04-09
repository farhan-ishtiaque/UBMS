<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $primaryKey = 'dept_id';

    protected $fillable = ['uni_id', 'dept_name', 'email_address', 'phone_number', 'programs'];

    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id');
    }

    public function students()
    {
        return $this->hasMany(Students::class, 'dept_id');
    }

    public function faculties()
    {
        return $this->hasMany(Faculties::class, 'dept_id');
    }

    public function courses()
    {
        return $this->hasMany(Courses::class, 'dept_id');
    }

    public function jobPostings()
    {
        return $this->hasMany(JobPostings::class, 'dept_id');
    }
}
