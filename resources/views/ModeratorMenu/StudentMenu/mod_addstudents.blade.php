<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register Student</title>
    <link rel="stylesheet" href="{{ asset('css/mod_addstudents.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <div class="back-btn-container">
            <a href="{{ route('mod_students_menu') }}" class="back-btn">← Back</a>
        </div>

        <h2>Student Registration</h2>

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="uni_id">University</label>
                <select id="uni_id" name="uni_id" required>
                    <option value="">Select a University</option>
                    @foreach($universities as $university)
                        <option value="{{ $university->uni_id }}">{{ $university->uni_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="dept_id">Department</label>
                <select id="dept_id" name="dept_id" required>
                    <option value="">Select a Department</option>
                </select>
            </div>

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input name="first_name" type="text" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input name="last_name" type="text" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input name="phone_number" type="text">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input name="address" type="text">
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input name="date_of_birth" type="date" required>
            </div>

            <div class="form-group">
                <label for="cgpa">CGPA</label>
                <input name="cgpa" type="number" step="0.01" min="0" max="4">
            </div>

            <div class="form-group">
                <label for="graduation_status">Graduation Status</label>
                <select name="graduation_status" required>
                    <option value="not_graduated">Not Graduated</option>
                    <option value="graduated">Graduated</option>
                </select>
            </div>

            <button type="submit" class="btn">Register Student</button>
        </form>
    </div>

    <script>
        document.getElementById('uni_id').addEventListener('change', function () {
            const universityId = this.value;
            const deptSelect = document.getElementById('dept_id');

            fetch(`{{ url('/departments/by-university') }}/${universityId}`)
                .then(response => response.json())
                .then(data => {
                    deptSelect.innerHTML = '<option value="">Select a Department</option>';
                    data.forEach(dept => {
                        deptSelect.innerHTML += `<option value="${dept.dept_id}">${dept.dept_name}</option>`;
                    });
                });
        });
    </script>

</body>

</html>