<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Course;
use Illuminate\Http\Request;

class FacultyCourseAssignmentController extends Controller
{
    public function create($facultyId)
    {
        $faculty = Faculty::with(['department.courses', 'courses'])->findOrFail($facultyId);
        
        // Get courses from the faculty's department that aren't already assigned
        $assignedCourseIds = $faculty->courses->pluck('course_id')->toArray();
        
        $availableCourses = Courses::where('dept_id', $faculty->dept_id)
                                ->whereNotIn('course_id', $assignedCourseIds)
                                ->get();
        
        return view('assign_courses', [
            'faculty' => $faculty,
            'availableCourses' => $availableCourses,
            'assignedCourses' => $faculty->courses
        ]);
    }

    public function store(Request $request, $facultyId)
    {
        $request->validate([
            'courses' => 'required|array',
            'semester' => 'required|string',
        ]);
        
        $faculty = Faculty::findOrFail($facultyId);
        
        $coursesToAssign = [];
        foreach ($request->courses as $courseId) {
            $coursesToAssign[$courseId] = [
                'semester' => $request->semester,
                'is_primary_instructor' => $request->has('is_primary')
            ];
        }
        
        $faculty->courses()->syncWithoutDetaching($coursesToAssign);
        
        return redirect()->back()->with('success', 'Courses assigned successfully!');
    }

    public function destroy($facultyId, $courseId, Request $request)
    {
        $faculty = Faculty::findOrFail($facultyId);
        $faculty->courses()->wherePivot('semester', $request->semester)->detach($courseId);
        
        return redirect()->back()->with('success', 'Course assignment removed!');
    }
}