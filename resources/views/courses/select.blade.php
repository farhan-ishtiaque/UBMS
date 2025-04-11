@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Update Courses</h2>

    <form method="GET" action="{{ route('courses.select') }}">
        <div class="mb-3">
            <label for="uni_id">University</label>
            <select name="uni_id" id="uni_id" class="form-select" onchange="this.form.submit()">
                <option value="">Select University</option>
                @foreach($universities as $uni)
                    <option value="{{ $uni->uni_id }}" {{ $selectedUni == $uni->uni_id ? 'selected' : '' }}>
                        {{ $uni->uni_name }}
                    </option>
                @endforeach
            </select>
        </div>

        @if($departments->count())
        <div class="mb-3">
            <label for="dept_id">Department</label>
            <select name="dept_id" id="dept_id" class="form-select" onchange="this.form.submit()">
                <option value="">Select Department</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->dept_id }}" {{ $selectedDept == $dept->dept_id ? 'selected' : '' }}>
                        {{ $dept->dept_name }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif
    </form>

    @if($courses->count())
        <h4 class="mt-4">Courses</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Credits</th>
                    <th>Semester</th>
                    <th>Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->credits }}</td>
                    <td>{{ $course->semester }}</td>
                    <td>{{ $course->year }}</td>
                    <td>
                        <a href="{{ route('courses.edit', $course->course_id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
