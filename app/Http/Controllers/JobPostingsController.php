<?php

namespace App\Http\Controllers;
use App\Models\FacultyRecruitment;
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
public function index2(Request $request)
{
    // If there's a university name provided, filter the job postings
    $jobPostings = JobPostings::with(['university', 'department'])
        ->when($request->uni_name, function ($query) use ($request) {
            return $query->whereHas('university', function ($q) use ($request) {
                $q->where('uni_name', 'like', '%' . $request->uni_name . '%');
            });
        })
        ->latest()
        ->get();

    return view('job_postings.index2', compact('jobPostings'));
}

public function showApplicants($jobId)
{
    // Get the applicants for a specific job posting
    $applicants = FacultyRecruitment::where('job_id', $jobId)->get();

    return view('job_postings.applicants', compact('applicants', 'jobId'));
}
}