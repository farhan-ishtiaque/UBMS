<?php
namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Faculties;
use App\Models\University;
use App\Models\FacultyRecruitment;
use App\Models\JobPostings;
use Illuminate\Http\Request;

class FacultyRecruitmentController extends Controller
{
  public function create($job_id)
        {
            return view('faculty_recruitment.create', ['job_id' => $job_id, 'departments' => Departments::all(), 'universities' => University::all()]);
        }
        
    

    public function store(Request $request)
    {
       
        $request->validate([
            'job_id' => 'required|exists:job_postings,job_id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email',
            'qualification' => 'required|string|max:255',
            'teaching_experience' => 'required|numeric|min:0',

            'dept_id' => 'required|exists:departments,dept_id', // Validate dept_id
            'uni_id' => 'required|exists:universities,uni_id', // Validate uni_id
        ]);

        // Create the faculty recruitment record
        $facultyRecruitment = FacultyRecruitment::create([
            'job_id' => $request->job_id,
            'dept_id' => $request->dept_id, // Save dept_id
            'uni_id' => $request->uni_id, // Save uni_id
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'designation' => $request->designation,
            'email' => $request->email,
            'qualification' => $request->qualification,
            'teaching_experience' => $request->teaching_experience,
            'recruitment_status' => 'Waiting', // Default status
        ]);
        

        return redirect()->route('job-listings.index')->with('success', 'Application submitted!');
    }

    public function updateStatus($applicantId, Request $request)
    {
        // Find the applicant by ID
        $applicant = FacultyRecruitment::find($applicantId);

        if (!$applicant) {
            return redirect()->route('job-listings.index')->with('error', 'Applicant not found!');
        }

        // Get the new status from the request
        $newStatus = $request->input('recruitment_status');

        // Update the recruitment status of the applicant
        $applicant->recruitment_status = $newStatus;
        $applicant->save();

        // If the status is 'Approved', move the applicant's data to the faculties table
        if ($newStatus == 'Approved') {
            // Ensure that the job posting, department, and university data is available
            $jobPosting = JobPostings::find($applicant->job_id);
            $department = $jobPosting ? $jobPosting->department : null;
            $university = $jobPosting ? $jobPosting->university : null;

            // Create a new Faculty record in the faculties table
            Faculties::create([
                'dept_id' => $applicant->dept_id, // Use dept_id from the applicant
                'uni_id' => $applicant->uni_id, // Use uni_id from the applicant
                'first_name' => $applicant->first_name,
                'middle_name' => $applicant->middle_name,
                'last_name' => $applicant->last_name,
                'designation' => $applicant->designation,
                'email' => $applicant->email,
                'qualification' => $applicant->qualification,
                'teaching_experience' => $applicant->teaching_experience,
            ]);
        }

        // Redirect to the job applicants page after status update
        return redirect()->route('job-listings.applicants', ['jobId' => $applicant->job_id])
                         ->with('success', 'Recruitment status updated successfully!');
}
}