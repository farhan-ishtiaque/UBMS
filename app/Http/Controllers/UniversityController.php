<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    // Method to show accredited universities
    public function showAccredited()
    {
        // Fetch all universities with accreditation status 'Accredited'
        $universities = University::where('accreditation_status', 'Accredited')->get(['uni_name', 'district', 'email_address']);

        // Return the view with the universities data
        return view('universities.accredited', compact('universities'));
    }
}