<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyDevelopment extends Model
{
    protected $primaryKey = 'development_id';

    protected $fillable = ['program_name', 'program_type', 'start_date', 'end_date', 'status'];

    public function faculties()
    {
        return $this->belongsToMany(Faculties::class, 'faculty_development_faculty');
    }
}
