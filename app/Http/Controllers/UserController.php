<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Show all users with pagination
    public function showUsers(Request $request)
    {
        // Get all users and paginate (10 per page)
        $users = User::paginate(10);

        // Return the view 'user.blade.php' which will display all users
        return view('user', compact('users'));
    }

    // Show users based on search criteria
    public function showSearchedUsers(Request $request)
    {
        $query = User::query();

        // If there's a search query, filter the users
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('email', 'like', "%$search%")
                ->orWhere('FirstName', 'like', "%$search%")
                ->orWhere('LastName', 'like', "%$search%");
        }

        // Paginate the filtered users
        $users = $query->paginate(10);

        // Return the same 'user.blade.php' view with filtered users
        return view('userSearch', compact('users'));
    }

    // Show the edit form for a specific user
    public function editUser($id)
    {
        $user = User::findOrFail($id); // Get the user by ID

        // Return the view for editing the user
        return view('edit', compact('user'));  // This will load 'edit.blade.php'
    }

    // Handle the update of user information
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id); // Get the user by ID

        // Validate the incoming data
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'PhoneNumber' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $id . ',user_id',

        ]);

        // Update the user data
        $user->FirstName = $request->input('FirstName');
        $user->LastName = $request->input('LastName');
        $user->PhoneNumber = $request->input('PhoneNumber');
        $user->email = $request->input('email');
        $user->save();

        // Redirect back to the user list with a success message
        return redirect()->route('mod_users_menu')->with('success', 'User updated successfully'); // Change the redirect route
    }
    // Show confirmation page
    public function confirmDelete($id)
    {
        $user = User::findOrFail($id);
        return view('confirm-delete', compact('user'));
    }
    
    public function deleteUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.delete.page')->with('success', 'User deleted successfully.');
}
// Page for deleting users (with search)
public function showDeleteUsers(Request $request)
{
    $users = User::paginate(10);
    return view('userDelete', compact('users'));
}

public function searchDeleteUsers(Request $request)
{
    $query = User::query();

    if ($request->has('search') && $request->input('search') != '') {
        $search = $request->input('search');
        $query->where('email', 'like', "%$search%")
            ->orWhere('FirstName', 'like', "%$search%")
            ->orWhere('LastName', 'like', "%$search%");
    }

    $users = $query->paginate(10);
    return view('userDelete', compact('users'));
}


}
