<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Departments;
use App\Models\Courses;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $universities = University::all();
        $departments = collect();
        $courses = collect();

        $uni_id = $request->input('uni_id');
        $dept_id = $request->input('dept_id');

        if ($uni_id) {
            $departments = Departments::where('uni_id', $uni_id)->get();
        }

        if ($dept_id) {
            $courses = Courses::where('dept_id', $dept_id)->get();
        }

        return view('courses.index', compact('universities', 'departments', 'courses'));
    }
  public function create()
    {
        $universities = University::with('departments')->get();
        return view('courses.create', compact('universities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'dept_id'     => 'required|exists:departments,dept_id',
            'credits'     => 'required|integer|min:1',
            'semester'    => 'required|string|max:20',
            'year'        => 'required|integer|min:2000',
        ]);
    
        Courses::create([
            'course_name' => $request->course_name,
            'dept_id'     => $request->dept_id,
            'credits'     => $request->credits,
            'semester'    => $request->semester,
            'year'        => $request->year,
        ]);
    
        return redirect()->route('courses.create')->with('success', 'Course created successfully!');
    }
    
    public function edit($id)
    {
        $course = Courses::findOrFail($id);
        $departments = Departments::all();
        $universities = University::all();
        $selectedUniversityId = $course->department->uni_id ?? null;
    
        return view('courses.edit', compact('course', 'departments', 'universities', 'selectedUniversityId'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'course_name' => 'required|string|max:255',
            'credits' => 'required|numeric',
            'semester' => 'required|string|max:50',
            'year' => 'required|numeric',
        ]);
    
        // Find the course to update
        $course = Courses::findOrFail($id);
    
        // Update the course with the validated data
        $course->update([
            'course_name' => $request->course_name,
            'credits' => $request->credits,
            'semester' => $request->semester,
            'year' => $request->year,
            // Remove the department and university updates as they are no longer in the form
        ]);
    
        // Redirect back with a success message
        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }
    
    public function list(Request $request)
{
    $universities = University::with('departments')->get();
    $departments = Departments::all();
    $courses = [];

    if ($request->university && $request->department) {
        $courses = Courses::where('dept_id', $request->department)->get();
    }

    // 👇 this line is important
    return view('courses.deleteList', [
        'universities' => $universities,
        'departments' => $departments,
        'courses' => $courses,
        'request' => $request // ← make sure this is passed
    ]);
}

    // Show the delete confirmation page
    public function confirmDelete($id)
    {
        $course = Courses::findOrFail($id);
        return view('courses.delete', compact('course'));
    }

    // Handle the actual course deletion
    public function delete($id)
    {
        $course = Courses::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.list')->with('success', 'Course deleted successfully!');
    }

    
    public function selectPage(Request $request)
    {
        $universities = University::all(); // Make sure this returns data!
        $departments = collect();
        $courses = collect();
    
        $selectedUni = $request->input('uni_id');
        $selectedDept = $request->input('dept_id');
    
        if ($selectedUni) {
            $departments = Departments::where('uni_id', $selectedUni)->get();
        }
    
        if ($selectedDept) {
            $courses = Courses::where('dept_id', $selectedDept)->get();
        }
    
        return view('courses.select', compact('universities', 'departments', 'courses', 'selectedUni', 'selectedDept'));
    }
    
}


