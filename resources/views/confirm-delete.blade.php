<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Delete</title>
    <link href="{{ asset('css/delete.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 style="color: red;">Delete Confirmation</h1>

        <p><strong>Name:</strong> {{ $user->FirstName }} {{ $user->LastName }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->PhoneNumber }}</p>

        <p style="color: red;">⚠️ Are you sure you want to delete this user?</p>

        <form method="POST" action="{{ route('user.delete', $user->id) }}">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn-delete">Yes, Delete</button>
    <a href="{{ route('users.list') }}" class="btn-cancel">Cancel</a>
</form>

    </div>
</body>
</html>
