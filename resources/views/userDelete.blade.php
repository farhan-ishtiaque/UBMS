<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Users</title>
    <link href="{{ asset('css/delete-user.css') }}" rel="stylesheet">
    <style>
        /* Add back button styles */
        .back-button-container {
            margin-bottom: 20px;
        }
        .back-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
        
        /* Existing styles */
        .delete-form {
            display: inline;
        }
        .delete-link {
            background: none;
            border: none;
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
            padding: 0;
            font: inherit;
        }
        .delete-link:hover {
            color: #0056b3;
            text-decoration: none;
        }
        .success-message {
            color: green;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <!-- Back Button -->
    <div class="back-button-container">
        <a href="{{ route('mod_users_menu') }}" class="back-button">← Back to Menu</a>
    </div>

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
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->FirstName }}</td>
                    <td>{{ $user->LastName }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->PhoneNumber }}</td>
                    <td>
                        <!-- Delete form -->
                        <form class="delete-form" action="{{ route('user.delete', $user->user_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-link">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        {{ $users->links() }}
    </div>

    <!-- JavaScript for confirmation -->
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this user?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>