<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>

    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optionally add custom CSS -->
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
        }
        .table {
            background-color: #ffffff; /* White background for the table */
        }
        .table th, .table td {
            color: #007bff; /* Blue text color */
        }
    </style>
</head>
<body>


    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS and Popper.js (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
