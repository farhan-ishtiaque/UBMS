<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Users</title>
    <link href="{{ asset('css/delete-user.css') }}" rel="stylesheet">
</head>
<body>
    <h1>Delete Users</h1>

    <!-- Search Form -->
    <form action="{{ route('users.search.delete') }}" method="get">
        <input type="text" name="search" placeholder="Search by name or email" value="{{ request()->input('search') }}">
        <button type="submit">Search</button>
    </form>

    <!-- Success Message -->
    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <!-- Users Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Action</th>
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
                        <a href="{{ route('user.confirmDelete', $user->id) }}" class="delete-link">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        {{ $users->links() }}
    </div>
</body>
</html>
