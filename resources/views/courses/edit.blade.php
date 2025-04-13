@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('mod_students_menu') }}" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
        </a>
        <h2>Edit Course</h2>

        <form action="{{ route('courses.update', $course->course_id) }}" method="POST">
            @csrf
            @method('PUT')
        
            <div class="mb-3">
                <label for="course_name" class="form-label">Course Name</label>
                <input type="text" class="form-control @error('course_name') is-invalid @enderror" id="course_name" name="course_name"
                    value="{{ old('course_name', $course->course_name) }}">
                @error('course_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="mb-3">
                <label for="credits" class="form-label">Credits</label>
                <input type="number" class="form-control @error('credits') is-invalid @enderror" id="credits" name="credits"
                    value="{{ old('credits', $course->credits) }}">
                @error('credits')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="mb-3">
                <label for="course_code" class="form-label">Course Code</label>
                <input type="text" class="form-control @error('course_code') is-invalid @enderror" id="course_code" name="course_code"
                    value="{{ old('course_code', $course->course_code) }}">
                @error('course_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="mb-3">
                <label for="dept_id" class="form-label">Department</label>
                <select class="form-control @error('dept_id') is-invalid @enderror" id="dept_id" name="dept_id">
                    @foreach($departments as $department)
                        <option value="{{ $department->dept_id }}" {{ old('dept_id', $course->dept_id) == $department->dept_id ? 'selected' : '' }}>
                            {{ $department->dept_name }}
                        </option>
                    @endforeach
                </select>
                @error('dept_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        
            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
    </div>
@endsection