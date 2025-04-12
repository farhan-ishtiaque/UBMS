<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\University; 
use Illuminate\Support\Facades\Log;

class UniversityController extends Controller
{
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
            // Prepare data for saving
            $data = $request->except(['_token', 'acceptConditions']);
            $data['accredited'] = false; // Set accredited status to false

            // Save to the universities table
            University::create($data);

            return redirect()->route('university.registration')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return back()->with('error', 'Registration failed. Please try again.')->withInput();
        }
    }
    public function showUpdateForm(Request $request)
{
    $universities = University::where('accreditation_status', 'Not Accredited')->get();
    $selectedUniversityId = $request->input('universityId');
    $university = null;

    if ($selectedUniversityId) {
        $university = University::find($selectedUniversityId);
    }

    return view('universityUpdate', [
        'universities' => $universities,
        'university' => $university
    ]);
}

public function updateAccreditation(Request $request, $id)
{
    $request->validate([
        'accreditation_status' => 'required|in:Accredited,Not Accredited',
    ]);

    $university = University::findOrFail($id);
    $university->accreditation_status = $request->accreditation_status;
    $university->save();

    return redirect()->route('homepage')->with('success', 'University accredited successfully.');
}

     public function showAccredited()
     {
         // Fetch universities where accreditation_status is 'accredited'
         $accreditedUniversities = University::where('accreditation_status', 'accredited')->get();
     
         // Return them to a view (e.g., accreditedUniversities.blade.php)
         return view('universities', compact('accreditedUniversities'));
     }
     
}