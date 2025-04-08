<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UniversityAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function login()
    {
        return view('login');
    }

    public function registration()
{
    $universities = \App\Models\University::all(); // assuming you have a University model
    return view('registration', compact('universities'));
}


    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->intended('homepage')->with('success', 'Login successful');
        }

        return redirect()->back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();
    }

    public function registrationPost(Request $request)
    {
        if ($request->has('FirstName') && $request->has('LastName')) {
            // Manual Registration
            $request->validate([
                'FirstName' => 'required|string|max:255',
                'LastName' => 'required|string|max:255',
                'PhoneNumber' => 'required|string|max:15',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = new User();
            $user->FirstName = $request->input('FirstName');
            $user->LastName = $request->input('LastName');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->type = 'umsb_personnel';
            $user->phoneNumber = $request->input('PhoneNumber');
            $user->save();

            return redirect()->route('homepage')->with('success', 'Registration successful. Please log in.');
        } elseif ($request->has('university') && $request->has('uniAdmin')) {
            // University Registration
            $universityAdmin = UniversityAdmin::find($request->input('uniAdmin'));

            if (!$universityAdmin) {
                return redirect()->back()->withErrors(['uniAdmin' => 'Selected university admin not found.']);
            }

            $user = new User();
            $user->FirstName = $universityAdmin->first_name;
            $user->LastName = $universityAdmin->last_name;
            $user->email = $universityAdmin->email;
            $user->password = bcrypt('password');
            $user->type = 'university_admin';
            $user->PhoneNumber = $universityAdmin->phone_number;
            $user->save();

            return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
        }

        return redirect()->back()->withErrors(['registration' => 'Invalid registration data.']);
    }

    function logout()
    {
        auth()->logout();
        return redirect()->route('homepage')->with('success', 'Logged out successfully');
    }


}
