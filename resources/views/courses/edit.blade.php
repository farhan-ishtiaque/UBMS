@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Course</h2>

    <form action="{{ route('courses.update', $course->course_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" value="{{ old('course_name', $course->course_name) }}">
        </div>

        <div class="mb-3">
            <label for="credits" class="form-label">Credits</label>
            <input type="number" class="form-control" id="credits" name="credits" value="{{ old('credits', $course->credits) }}">
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="text" class="form-control" id="semester" name="semester" value="{{ old('semester', $course->semester) }}">
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $course->year) }}">
        </div>

        <!-- Removed Department Dropdown -->
        <!-- Removed University Dropdown -->

        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>
@endsection
