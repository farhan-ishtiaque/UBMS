@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('mod_courses_menu') }}" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
        </a>
        <h1>Create New Course</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            {{-- University Selector --}}
            <div class="form-group">
                <label for="university">University</label>
                <select id="university" class="form-control" required>
                    <option value="">Select University</option>
                    @foreach($universities as $university)
                        <option value="{{ $university->uni_id }}">{{ $university->uni_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Department Selector --}}
            <div class="form-group">
                <label for="dept_id">Department</label>
                <select name="dept_id" id="dept_id" class="form-control" required disabled>
                    <option value="">Select a university first</option>
                </select>
            </div>

            {{-- Course Name --}}
            <div class="form-group">
                <label for="course_name">Course Name</label>
                <input type="text" name="course_name" class="form-control" required>
            </div>

            {{-- Credits --}}
            <div class="form-group">
                <label for="credits">Credits</label>
                <input type="number" name="credits" class="form-control" min="1" required>
            </div>

            {{-- Course Code --}}
            <div class="form-group">
                <label for="course_code">Course Code</label>
                <input type="text" name="course_code" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Course</button>
        </form>
    </div>

    {{-- JavaScript to Populate Departments --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const universities = @json($universities);
            const universitySelect = document.getElementById('university');
            const departmentSelect = document.getElementById('dept_id');

            universitySelect.addEventListener('change', function () {
                const selectedId = parseInt(this.value);
                departmentSelect.innerHTML = '<option value="">Select Department</option>';
                departmentSelect.disabled = true;

                if (selectedId) {
                    const selectedUni = universities.find(u => u.uni_id == selectedId);
                    if (selectedUni && selectedUni.departments.length > 0) {
                        selectedUni.departments.forEach(dept => {
                            const option = document.createElement('option');
                            option.value = dept.dept_id;
                            option.textContent = dept.dept_name;
                            departmentSelect.appendChild(option);
                        });
                        departmentSelect.disabled = false;
                    } else {
                        departmentSelect.innerHTML = '<option value="">No departments found</option>';
                    }
                } else {
                    departmentSelect.innerHTML = '<option value="">Select a university first</option>';
                }
            });
        });
    </script>
@endsection