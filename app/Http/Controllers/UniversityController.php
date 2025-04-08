<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function showAccredited()
    {
        $universities = University::where('accreditation_status', 'accredited')
            ->select('uni_name', 'district', 'email_address', 'phone_number')
            ->get();

        return view('universities', compact('universities'));
    }
}