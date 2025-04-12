@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Are you sure you want to delete this course?</h1>

    <div class="alert alert-warning">
        <p>Course: <strong>{{ $course->course_name }}</strong></p>
        <p>Department: <strong>{{ $course->department->dept_name }}</strong></p>
        <p>University: <strong>{{ $course->department->university->uni_name }}</strong></p>
    </div>

    <form action="{{ route('courses.delete', $course->course_id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">Yes, delete it!</button>
        <a href="{{ route('courses.list') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
