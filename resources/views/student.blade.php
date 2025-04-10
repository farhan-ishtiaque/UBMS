@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Students</h1>

    <form method="GET" action="{{ route('students.index') }}" class="mb-3">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by first or last name" class="form-control w-50 d-inline-block">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <a href="{{ route('students.create') }}" class="btn btn-success mb-3">Add New Student</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Gender</th>
                <th>University</th>
                <th>Graduation Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                    <td>{{ ucfirst($student->gender) }}</td>
                    <td>{{ $student->university->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $student->graduation_status)) }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info">View</a>
                        <form action="{{ route('students.destroy', $students) }}" method="POST" class="d-inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No students found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $students->links() }}
</div>
@endsection
