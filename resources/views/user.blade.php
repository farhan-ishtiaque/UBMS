<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}"> <!-- Link to your custom CSS file -->
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-primary mb-4 text-center">List of All Users</h1> <!-- Centered Title -->

        @if($users->isEmpty())
            <div class="alert alert-warning" role="alert">
                No users found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->FirstName }}</td>
                                <td>{{ $user->LastName }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->PhoneNumber }}</td>
                                <td>{{ ucfirst($user->type) }}</td> <!-- Display the user role -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
