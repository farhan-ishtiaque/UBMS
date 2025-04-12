<?php
namespace App\Http\Controllers;

use App\Models\FacultyRecruitment;
use App\Models\JobPostings;
use Illuminate\Http\Request;

class FacultyRecruitmentController extends Controller
{public function create($job_id)
    {
        return view('faculty_recruitment.create', ['job_id' => $job_id]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:job_postings,job_id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'teaching_experience' => 'required|string|max:255',
        ]);
    
        FacultyRecruitment::create([
            'job_id' => $request->job_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'designation' => $request->designation,
            'email' => $request->email,
            'qualification' => $request->qualification,
            'teaching_experience' => $request->teaching_experience,
            'recruitment_status' => 'Waiting',
        ]);
    
        return redirect()->route('job-postings.index')->with('success', 'Application submitted!');
    }
    
}
