@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Courses to Faculty</h2>
    
    <form method="POST" action="{{ route('faculty.assign-courses.store', $faculty->faculty_id) }}">
        @csrf
        
        <div class="form-group">
            <label for="faculty">Faculty Member:</label>
            <input type="text" class="form-control" value="{{ $faculty->first_name }} {{ $faculty->last_name }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="department">Department:</label>
            <input type="text" class="form-control" value="{{ $faculty->department->dept_name }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="courses">Select Courses:</label>
            <select multiple class="form-control" id="courses" name="courses[]" required>
                @foreach($availableCourses as $course)
                    <option value="{{ $course->course_id }}">
                        {{ $course->course_name }} ({{ $course->semester }} {{ $course->year }})
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="semester">Semester:</label>
            <select class="form-control" id="semester" name="semester" required>
                <option value="Spring">Spring</option>
                <option value="Summer">Summer</option>
                <option value="Fall">Fall</option>
                <option value="Winter">Winter</option>
            </select>
        </div>
        
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_primary" name="is_primary">
            <label class="form-check-label" for="is_primary">Primary Instructor</label>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Assign Courses</button>
    </form>
    
    <hr>
    
    <h3>Currently Assigned Courses</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Semester</th>
                <th>Primary Instructor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignedCourses as $course)
                <tr>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->pivot->semester }}</td>
                    <td>{{ $course->pivot->is_primary_instructor ? 'Yes' : 'No' }}</td>
                    <td>
                        <form action="{{ route('faculty.assign-courses.destroy', [$faculty->faculty_id, $course->course_id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="semester" value="{{ $course->pivot->semester }}">
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection