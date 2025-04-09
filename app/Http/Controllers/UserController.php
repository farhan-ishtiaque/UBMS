<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUsers()
    {
        // Get all users from the database
        $users = User::all();
        
        // Pass the users data to the view
        return view('users.index', compact('users'));
    }
}
