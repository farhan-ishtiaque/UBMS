<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login()
    {
        return view('login');
    }

    function registration()
    {
        return view('registration');
    }

    /*function loginPost(Request $request)
    {
        //echo "Login Post";
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        

       
        
        // Attempt to log the user in
        if (auth()->attempt($request->only('email', 'password'))) {
            // Redirect to the intended page or dashboard
            return redirect()->intended('homepage')->with('success', 'Login successful');
        }

        // If authentication fails, redirect back with an error message
        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }*/

    function loginPost(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Find admin by email (without hashing check)
        $admin = Admin::where('email', $request->email)->first();
    
        // Compare plain-text passwords (INSECURE - for debugging only)
        if ($admin && $request->password === $admin->password) {
            // Manually log in the user (still uses hashing for session)
            Auth::guard('admin')->login($admin);
            return redirect()->route('homepage');
        }
    
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    function registrationPost(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
    function logout()
    {
        auth()->logout();
        return redirect()->route('homepage')->with('success', 'Logged out successfully');
    }


}
