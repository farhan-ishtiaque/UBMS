<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UniversityController extends Controller
{
    public function showAccredited()
    {
        $accreditedUniversities = University::accredited()
            ->withCount('departments')
            ->with([
                'departments' => function ($query) {
                    $query->orderBy('dept_name');
                }
            ])
            ->orderBy('uni_name')
            ->paginate(10);

        return view('universities', compact('accreditedUniversities'));
    }

    public function showRegistrationForm()
    {
        return view('uniRegistration');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uniName' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'website' => 'required|url',
            'email' => 'required|email',
            'contactNumber' => 'required|string|max:15',
            'district' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'establishedYear' => 'required|integer|min:1900|max:' . date('Y'),
            'studentTeacherRatio' => 'required|string|max:10',
            'signatoryName' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'signature' => 'required|string|max:255',
            'submissionDate' => 'required|date',
            'acceptConditions' => 'accepted',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->except(['_token', 'acceptConditions']);
            $data['accreditation_status'] = 'Not Accredited'; // Default status

            University::create($data);

            return redirect()->route('university.registration')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return back()->with('error', 'Registration failed. Please try again.')->withInput();
        }
    }

    public function showUpdateForm(Request $request)
    {
        $universities = University::orderBy('uni_name')->get();
        $selectedUniversityId = $request->input('universityId');
        $university = null;

        if ($selectedUniversityId) {
            $university = University::findOrFail($selectedUniversityId);
        }

        return view('universityUpdate', compact('universities', 'university'));
    }

    public function updateAccreditation(Request $request, University $university)
    {
        $request->validate([
            'accreditation_status' => 'required|in:Accredited,Not Accredited',
        ]);

        $university->update([
            'accreditation_status' => $request->accreditation_status
        ]);

        return redirect()->route('universities.update')
            ->with('status', 'University accreditation updated successfully.');
    }
}