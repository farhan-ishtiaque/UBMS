<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyPhone extends Model
{
    protected $table = "faculty_phone_numbers";
    protected $fillable = ['student_id', 'phone_number'];

    public function faculty()
    {
        return $this->belongsTo(Faculties::class);
    }
}
