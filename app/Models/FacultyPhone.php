<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyPhone extends Model
{
    protected $table = 'faculty_phone_numbers';
    protected $fillable = ['faculty_id', 'phone_number'];

    public function faculty()
    {
        return $this->belongsTo(Faculties::class);
    }
    public function showFaculties(Request $request)
    {
        // Get all faculties and paginate (10 per page)
        $faculties = Faculties::paginate(10);

        // Return the view 'faculties.blade.php' which will display all faculties
        return view('faculties', compact('faculties'));
    }
}