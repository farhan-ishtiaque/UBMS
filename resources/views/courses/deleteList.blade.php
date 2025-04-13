@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('mod_students_menu') }}" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
        </a>
        <h1>Delete Courses</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Filter Form --}}
        <form method="GET" action="{{ route('courses.list') }}" class="mb-4">
            @csrf

            {{-- University Selector --}}
            <div class="form-group">
                <label for="university">University</label>
                <select id="university" name="university" class="form-control" required>
                    <option value="">Select University</option>
                    @foreach($universities as $university)
                        <option value="{{ $university->uni_id }}" {{ $request->university == $university->uni_id ? 'selected' : '' }}>
                            {{ $university->uni_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Department Selector --}}
            <div class="form-group">
                <label for="department">Department</label>
                <select id="department" name="department" class="form-control" required>
                    <option value="">Select Department</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Show Courses</button>
        </form>

        {{-- Courses Table --}}
        @if(count($courses) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Credits</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->course_code }}</td>
                            <td>{{ $course->credits }}</td>

                            <td>
                                <a href="{{ route('courses.delete.confirm', $course->course_id) }}"
                                    class="btn btn-danger">Delete</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- Dynamic Department Loader --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const universities = @json($universities);
            const universitySelect = document.getElementById('university');
            const departmentSelect = document.getElementById('department');
            const selectedDeptId = '{{ $request->department }}';

            function updateDepartments() {
                const selectedUniId = parseInt(universitySelect.value);
                departmentSelect.innerHTML = '<option value="">Select Department</option>';
                departmentSelect.disabled = true;

                const selectedUni = universities.find(u => u.uni_id == selectedUniId);
                if (selectedUni && selectedUni.departments.length > 0) {
                    selectedUni.departments.forEach(dept => {
                        const option = document.createElement('option');
                        option.value = dept.dept_id;
                        option.textContent = dept.dept_name;

                        if (selectedDeptId && selectedDeptId == dept.dept_id) {
                            option.selected = true;
                        }

                        departmentSelect.appendChild(option);
                    });
                    departmentSelect.disabled = false;
                }
            }

            universitySelect.addEventListener('change', updateDepartments);

            if (universitySelect.value) {
                updateDepartments();
            }
        });
    </script>
@endsection