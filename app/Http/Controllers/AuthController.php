<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function loginPost(Request $request)
{
    /*$user = \App\Models\User::where('email', $request->email)->first();
    dd($user);*/

    // Validate the request data
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
