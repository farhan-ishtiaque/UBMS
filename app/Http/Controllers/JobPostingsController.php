<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\Departments;
use App\Models\JobPostings;
use Illuminate\Http\Request;

class JobPostingsController extends Controller
{
    public function create()
    {
        // Load only accredited universities
        $universities = University::where('accreditation_status', 'accredited')->get();

        return view('job_postings.create', compact('universities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'uni_id' => 'required|exists:universities,uni_id',
            'dept_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'requirements' => 'required|string',
            'application_start_date' => 'required|date',
            'application_deadline' => 'required|date|after_or_equal:application_start_date',
        ]);

        // Find department by name
        $department = Departments::where('dept_name', $validated['dept_name'])->first();

        if (!$department) {
            return redirect()->back()->withErrors(['dept_name' => 'Department not found.'])->withInput();
        }

        // Create job posting
        JobPostings::create([
            'uni_id' => $validated['uni_id'],
            'dept_id' => $department->dept_id,
            'job_title' => $validated['job_title'],
            'job_type' => $validated['job_type'],
            'requirements' => $validated['requirements'],
            'application_start_date' => $validated['application_start_date'],
            'application_deadline' => $validated['application_deadline'],
        ]);

        return redirect()->back()->with('success', 'Job Posting Created Successfully!');
    }
    public function index()
{
    $jobPostings = JobPostings::with(['university', 'department'])->latest()->get();
    return view('job_postings.index', compact('jobPostings'));
}

}
