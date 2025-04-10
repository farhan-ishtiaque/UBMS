<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <title>Users List</title>
</head>
<body>
    <h1>All Users</h1>

    <!-- Search Form -->
    <form action="{{ route('users.search') }}" method="get">
        <input type="text" name="search" placeholder="Search users by name or email" value="{{ request()->input('search') }}">
        <button type="submit">Search</button>
    </form>

    <!-- Success Message -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Users Table -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->FirstName }}</td>
                    <td>{{ $user->LastName }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->PhoneNumber }}</td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $users->links() }}
</body>
</html>
