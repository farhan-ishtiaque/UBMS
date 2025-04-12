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
            <a href="{{ route('admin_students_menu') }}" class="back-btn">← Back</a>
        </div>

        <h2>Student Registration</h2>

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin_students.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="uni_id">University</label>
                <input type="text" value="{{ $university->uni_name }}" readonly>
                <input type="hidden" name="uni_id" value="{{ $university->uni_id }}">
            </div>

            <div class="form-group">
                <label for="dept_id">Department</label>
                <select id="dept_id" name="dept_id" required>
                    <option value="">Select a Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->dept_id }}">{{ $department->dept_name }}</option>
                    @endforeach
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
</body>

</html>