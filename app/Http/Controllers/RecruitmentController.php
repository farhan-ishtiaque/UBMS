<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPostings;
use App\Models\University;
use App\Models\FacultyRecruitment;

class RecruitmentController extends Controller
{
    public function showUpdateForm(Request $request)
    {
        $universities = University::all();
        $selectedUniversity = $request->input('university_id');
        
        $jobPostings = collect();
        
        if ($selectedUniversity) {
            $jobPostings = JobPostings::with(['department', 'facultyRecruitments'])
                ->where('uni_id', $selectedUniversity)
                ->get();
        }

        return view('faculty_recruitment.update-status', [
            'universities' => $universities,
            'jobPostings' => $jobPostings,
            'selectedUniversity' => $selectedUniversity
        ]);
    }

    public function saveStatusUpdates(Request $request)
    {
        $validated = $request->validate([
            'university_id' => 'required|exists:universities,uni_id',
            'statuses' => 'required|array',
            'statuses.*' => 'in:waiting,approved,declined' // Added validation for status values
        ]);

        foreach ($validated['statuses'] as $jobId => $status) {
            FacultyRecruitment::updateOrCreate(
                ['job_id' => $jobId],
                ['recruitment_status' => $status]
            );
        }

        return redirect()
            ->route('update-status', ['university_id' => $validated['university_id']])
            ->with('success', 'Statuses updated successfully!');
    }
}