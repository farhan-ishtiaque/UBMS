<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/university.css') }}">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="text-primary mb-4 text-center">List of All Students</h1>

    <form method="GET" action="{{ route('students.index') }}" class="form-inline mb-4 justify-content-center">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search by name or email" value="{{ request('search') }}">
        <select name="scholarship_status" class="form-control mr-2">
            <option value="">Filter by Scholarship</option>
            <option value="Recepient" {{ request('scholarship_status') == 'Recepient' ? 'selected' : '' }}>Recepient</option>
            <option value="Revoked" {{ request('scholarship_status') == 'Revoked' ? 'selected' : '' }}>Revoked</option>
            <option value="None" {{ request('scholarship_status') == 'None' ? 'selected' : '' }}>No Scholarship</option>
        </select>
        <button type="submit" class="btn btn-primary">View</button>
    </form>

    @if($students->isEmpty())
        <div class="alert alert-warning">No students found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>CGPA</th>
                    <th>Graduation Status</th>
                    <th>University</th>
                    <th>Scholarship Status</th>
                    <th>Scholarship Type</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                        <td>{{ ucfirst($student->gender) }}</td>
                        <td>{{ $student->cgpa ?? 'N/A' }}</td>
                        <td>{{ ucfirst($student->graduation_status) }}</td>
                        <td>{{ $student->department->university->uni_name ?? 'N/A' }}</td>
                        <td>
                            @if($student->scholarships->isEmpty())
                                <span class="badge badge-secondary">None</span>
                            @else
                                @foreach($student->scholarships as $s)
                                    <span class="badge badge-{{ $s->status === 'Recepient' ? 'success' : 'danger' }}">{{ $s->status }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @foreach($student->scholarships as $s)
                                <div>{{ $s->scholarship_type }}</div>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
</body>
</html>
