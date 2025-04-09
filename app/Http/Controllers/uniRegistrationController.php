<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\University;

class UniRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('uniRegistration');
    }

    public function register(Request $request)
    {

        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'universityName' => 'required|string|max:255',
            'uniType' => 'required|in:Public,Private',
            'portalCode' => 'required|string|max:50',
            'establishedYear' => 'required|integer|min:1900|max:' . date('Y'),
            'district' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'website' => 'nullable|url',
            'email' => 'nullable|email',
            'contactNumber' => 'nullable|string|max:15',
            'signatoryName' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'signature' => 'required|string|max:255',
            'submissionDate' => 'required|date',
            'acceptConditions' => 'accepted',  // Validates the checkbox
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Log::info('Validation passed, proceeding to try block.');

        try {
            // Map input fields to database columns
            Log::info('Attempting to save university data.');
            $universityData = [
                'uni_name' => $request->input('universityName'),
                'uni_type' => $request->input('uniType'),
                'postal_code' => $request->input('portalCode'),
                'established_year' => $request->input('establishedYear'),
                'district' => $request->input('district'),
                'area' => $request->input('area'),
                'website_url' => $request->input('website'),
                'email_address' => $request->input('email'),
                'phone_number' => $request->input('contactNumber'),
                'accreditation_status' => 'Not Accredited', // Default status
            ];

            // Save to the universities table
            University::create($universityData);

            return redirect()->route('homepage')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return back()->with('error', 'Registration failed. Please try again.')->withInput();
        }
    }
}
