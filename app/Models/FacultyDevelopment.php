<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyDevelopment extends Model
{
    protected $primaryKey = 'development_id';

    // Remove 'dept_id' from fillable since it's handled in pivot
    protected $fillable = ['dept_id','program_name', 'program_type', 'start_date', 'end_date'];
    public function department()
    {
        return $this->belongsTo(Departments::class, 'dept_id');
    }
}