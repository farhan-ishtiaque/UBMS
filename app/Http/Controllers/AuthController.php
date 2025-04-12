<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UniversityAdmin;
use App\Models\University;
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
        $universities = University::all();
        return view('registration', compact('universities'));
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            // Handle redirection based on user type
            switch ($user->type) {
                case 'moderators':
                    return redirect()->route('moderator.dashboard');
                
                case 'umsb_personnel':
                    return redirect()->route('ubms.dashboard');
                
                case 'university_admin':
                    session(['uni_id' => $user->uni_id]);
                    return redirect()->route('uniAdmin.dashboard');
                
                default:
                    auth()->logout();
                    return redirect()->route('login')->with('error', 'Unauthorized user type.');
            }
        }

        return redirect()->back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();
    }

    public function registrationPost(Request $request)
    {
        if ($request->input('registration_type') === 'manual') {
            // Manual Registration for UMSB personnel
            $request->validate([
                'FirstName' => 'required|string|max:255',
                'LastName' => 'required|string|max:255',
                'PhoneNumber' => 'required|string|max:15',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = User::create([
                'FirstName' => $request->input('FirstName'),
                'LastName' => $request->input('LastName'),
                'PhoneNumber' => $request->input('PhoneNumber'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'type' => 'umsb_personnel',
            ]);

            Auth::login($user);
            return redirect()->route('ubms.dashboard')->with('success', 'Registration successful!');
            
        } elseif ($request->input('registration_type') === 'university') {
            // University Admin Registration
            $request->validate([
                'uni_id' => 'required|exists:universities,uni_id',
                'admin_id' => 'required|exists:university_admins,admin_id',
            ]);

            $universityAdmin = UniversityAdmin::find($request->input('admin_id'));

            // Check if this admin already has a user account
            $existingUser = User::where('email', $universityAdmin->email_address)->first();
            if ($existingUser) {
                return redirect()->back()->withErrors(['email' => 'This university admin already has an account.']);
            }

            $user = User::create([
                'FirstName' => $universityAdmin->first_name,
                'LastName' => $universityAdmin->last_name,
                'PhoneNumber' => $universityAdmin->phone_number,
                'email' => $universityAdmin->email_address,
                'password' => bcrypt('defaultpassword'), // Set a default password
                'type' => 'university_admin',
                'uni_id' => $universityAdmin->uni_id,
            ]);

            Auth::login($user);
            return redirect()->route('login')->with('success', 'University admin registration successful!');
        }

        return redirect()->back()->withErrors(['registration' => 'Invalid registration data.']);
    }

    public function getUniversityAdmins(Request $request)
    {
        $admins = UniversityAdmin::where('uni_id', $request->uni_id)->get();
        return response()->json($admins);
    }

    function logout()
    {
        auth()->logout();
        return redirect()->route('homepage')->with('success', 'Logged out successfully');
    }
}