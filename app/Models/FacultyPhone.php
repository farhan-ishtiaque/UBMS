<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyPhone extends Model
{
    protected $table = 'faculty_phone_numbers';
    protected $primaryKey = 'id';
    protected $fillable = ['faculty_id', 'phone_number'];

    public function faculty()
    {
        return $this->belongsTo(Faculties::class, 'faculty_id', 'faculty_id');
    }

    public static function getByFacultyId($facultyId)
    {
        return self::where('faculty_id', $facultyId)->get();
    }
}