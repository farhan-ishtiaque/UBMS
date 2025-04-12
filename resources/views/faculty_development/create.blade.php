<!-- resources/views/faculty_development/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Faculty Development Program</h2>
    <form method="POST" action="{{ route('faculty_development.store') }}">
        @csrf
        
        <div class="form-group">
    <label for="dept_id">Department</label>
    <select class="form-control" id="dept_id" name="dept_id" required>
        <option value="">Select Department</option>
        @foreach($departments as $department)
            <option value="{{ $department->dept_id }}">
                {{ $department->dept_name }} ({{ $department->programs }})
            </option>
        @endforeach
    </select>
</div>
        <div class="form-group">
            <label for="program_name">Program Name</label>
            <input type="text" class="form-control" id="program_name" name="program_name" required>
        </div>
        
        <div class="form-group">
            <label for="program_type">Program Type</label>
            <select class="form-control" id="program_type" name="program_type" required>
                <option value="workshop">Workshop</option>
                <option value="seminar">Seminar</option>
                <option value="conference">Conference</option>
                <option value="training">Training</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection