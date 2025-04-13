@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('mod_courses_menu') }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
    </a>
    <h2>View Courses</h2>

    <form method="GET" action="{{ route('courses.index') }}">
        <div class="form-group">
            <label for="uni_id">Select University:</label>
            <select class="form-control" id="uni_id" name="uni_id" onchange="this.form.submit()">
                <option value="">-- Select University --</option>
                @foreach($universities as $university)
                    <option value="{{ $university->uni_id }}" {{ request('uni_id') == $university->uni_id ? 'selected' : '' }}>
                        {{ $university->uni_name }}
                    </option>
                @endforeach
            </select>
        </div>

        @if($departments->isNotEmpty())
            <div class="form-group mt-3">
                <label for="dept_id">Select Department:</label>
                <select class="form-control" id="dept_id" name="dept_id" onchange="this.form.submit()">
                    <option value="">-- Select Department --</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->dept_id }}" {{ request('dept_id') == $department->dept_id ? 'selected' : '' }}>
                            {{ $department->dept_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
    </form>

    @if($courses && $courses->isNotEmpty())
        <div class="mt-4">
            <h4>Courses:</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Credit Code</th>
                        <th>Credits</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->course_code }}</td>
                            <td>{{ $course->credits }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif(request('dept_id'))
        <p>No courses found for this department.</p>
    @endif
</div>
@endsection
