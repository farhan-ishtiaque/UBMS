<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $primaryKey = 'course_id';

    protected $fillable = ['dept_id', 'course_name', 'credits', 'semester', 'year'];

    public function department()
    {
        return $this->belongsTo(Departments::class, 'dept_id');
    }

    public function students()
    {
        return $this->belongsToMany(Students::class, 'enrollment')
                    ->withPivot('attendance', 'grade', 'semester', 'year');
    }
}
