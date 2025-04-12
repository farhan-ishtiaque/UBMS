<!-- resources/views/assign_courses.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Courses to Faculty</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('faculty.assign-courses.store') }}">
        @csrf

        <div class="form-group">
            <label for="faculty_id">Select Faculty:</label>
            <select name="faculty_id" class="form-control" required>
                <option value="">-- Select Faculty --</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}">
                        {{ $faculty->first_name }} {{ $faculty->last_name }} ({{ $faculty->department->dept_name ?? 'No Department' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="courses">Select Courses:</label>
            <select name="courses[]" class="form-control" multiple required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">
                        {{ $course->course_name }} ({{ $course->semester }} {{ $course->year }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="semester">Semester:</label>
            <select class="form-control" name="semester" required>
                <option value="Spring">Spring</option>
                <option value="Summer">Summer</option>
                <option value="Fall">Fall</option>
                <option value="Winter">Winter</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Assign Courses</button>
    </form>
</div>
@endsection
