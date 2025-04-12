<?php
namespace App\Http\Controllers;

use App\Models\FacultyDevelopment;
use App\Models\Departments;
use Illuminate\Http\Request;

class FacultyDevelopmentController extends Controller
{
    public function index()
{
    $programs = FacultyDevelopment::with('department')->get();
    return view('faculty_development.index', compact('programs'));
}

    public function create()
    {
        $departments = Departments::all();
        return view('faculty_development.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dept_id' => 'required|exists:departments,dept_id',
            'program_name' => 'required|string|max:255',
            'program_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Create the faculty development program
        FacultyDevelopment::create($validated);

        return redirect()->route('faculty_development.index')
            ->with('success', 'Faculty development program created successfully!');
    }
}