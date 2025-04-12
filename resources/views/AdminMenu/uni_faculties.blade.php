<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculties List</title>
    <link href="{{ asset('css/facultyList.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .heading {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 32px;
        }

        .back-button {
            text-decoration: none;
            color: #3490dc;
            font-weight: bold;
            font-size: 16px;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 14px 16px;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #f0f0f0;
            color: #555;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination .flex {
            justify-content: center;
        }
    </style>
</head>
<body>
    @php
        if (!session('uni_id')) {
            header("Location: " . route('login'));
            exit;
        }
    @endphp

    <div class="container">
        <!-- Back Button -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('admin_faculties_menu') }}" class="back-button">← Back to Menu</a>
        </div>

        <h1 class="heading">Faculties List</h1>

        <!-- Faculties Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Qualification</th>
                    <th>University</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faculties as $faculty)
                    @if($faculty->uni_id == session('uni_id'))
                    <tr>
                        <td>{{ $faculty->faculty_id }}</td>
                        <td>{{ $faculty->first_name }} {{ $faculty->last_name }}</td>
                        <td>{{ $faculty->email }}</td>
                        <td>{{ $faculty->designation }}</td>
                        <td>{{ $faculty->qualification }}</td>
                        <td>{{ $faculty->uni_name }}</td>
                        <td>{{ $faculty->dept_name }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            {{ $faculties->links() }}
        </div>
    </div>

</body>
</html>