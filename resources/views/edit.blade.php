<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User: {{ $user->FirstName }} {{ $user->LastName }}</h1>

    <!-- Edit User Form -->
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="FirstName">First Name</label>
        <input type="text" name="FirstName" id="FirstName" value="{{ $user->FirstName }}" required><br><br>

        <label for="LastName">Last Name</label>
        <input type="text" name="LastName" id="LastName" value="{{ $user->LastName }}" required><br><br>

        <label for="PhoneNumber">Phone Number</label>
        <input type="text" name="PhoneNumber" id="PhoneNumber" value="{{ $user->PhoneNumber }}" required><br><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required><br><br>

        <button type="submit">Update User</button>
    </form>

</body>
</html>
