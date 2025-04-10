<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/facultyList.css') }}" rel="stylesheet">
    <title>Faculties List</title>
</head>
<body>

    <div class="container">
        <h1 class="heading">Faculties List</h1>

        <!-- Faculties Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Qualification</th>
                    <th>University Name</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faculties as $faculty)
                    <tr>
                        <td>{{ $faculty->faculty_id }}</td>
                        <td>{{ $faculty->first_name }} {{ $faculty->last_name }}</td>
                        <td>{{ $faculty->designation }}</td>
                        <td>{{ $faculty->qualification }}</td>
                        <td>{{ $faculty->uni_name }}</td> <!-- Display university name -->
                        <td>{{ $faculty->dept_name }}</td> <!-- Display department -->
                    </tr>
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
