<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\University; // Assuming your model is named University
use Illuminate\Support\Facades\Log;

class UniRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('uniRegistration');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'universityName' => 'required|string|max:255',
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
}