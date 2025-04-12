<?php


namespace App\Http\Controllers;

use App\Models\Faculties;
use App\Models\Courses;
use Illuminate\Http\Request;

class FacultyCourseAssignmentController extends Controller
{
    // Display form to assign courses to a faculty
    public function create()
    {
        $faculties = Faculties::all();  // Get all faculties
        $courses = Courses::all();     // Get all courses
        return view('assign_courses', compact('faculties', 'courses'));
    }

    // Store the course assignments
    public function store(Request $request)
    {
        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'courses' => 'required|array',
            'semester' => 'required|string',
        ]);

        $faculty = Faculties::findOrFail($request->faculty_id);

        // Prepare the data to insert into the pivot table
        $dataToAttach = [];
        foreach ($request->courses as $courseId) {
            $dataToAttach[$courseId] = [
                'semester' => $request->semester,
            ];
        }

        // Attach courses to faculty in pivot table
        $faculty->courses()->syncWithoutDetaching($dataToAttach);

        return redirect()->back()->with('success', 'Courses assigned successfully!');
}
}
