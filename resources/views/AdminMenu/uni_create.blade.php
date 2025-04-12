<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Faculty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .form-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .back-btn {
            margin-bottom: 20px;
        }

        .phone-number-container {
            margin-bottom: 15px;
        }

        .add-phone-btn {
            margin-bottom: 20px;
        }

        #loading-departments {
            display: none;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    @php
        if (!session('uni_id')) {
            header("Location: " . route('login'));
            exit;
        }
    @endphp

    <div class="container">
        
        <!-- Back Button -->
        <div class="back-container">
            <a href="{{ route('admin_faculties_menu') }}" class="btn btn-dark btn-sm back-button">← Back to Menu</a>
        </div>

        <div class="form-container">
            <h2 class="text-center mb-4">Register New Faculty</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('uni_faculties_store') }}">
                @csrf

                <input type="hidden" name="uni_id" value="{{ session('uni_id') }}">

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">University</label>
                        <input type="text" class="form-control" value="{{ session('uni_name') }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="dept_id" class="form-label">Department</label>
                        <select class="form-select" id="dept_id" name="dept_id" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->dept_id }}">{{ $department->dept_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name">
                    </div>
                    <div class="col-md-4">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="qualification" class="form-label">Qualification</label>
                        <input type="text" class="form-control" id="qualification" name="qualification" required>
                    </div>
                    <div class="col-md-6">
                        <label for="teaching_experience" class="form-label">Teaching Experience (years)</label>
                        <input type="number" class="form-control" id="teaching_experience"
                            name="teaching_experience">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Numbers</label>
                    <div id="phone-numbers-container">
                        <div class="phone-number-container input-group mb-2">
                            <input type="text" class="form-control" name="phone_numbers[]"
                                placeholder="Phone number">
                            <button type="button" class="btn btn-outline-danger remove-phone">×</button>
                        </div>
                    </div>
                    <button type="button" id="add-phone" class="btn btn-outline-primary add-phone-btn">
                        + Add Another Phone Number
                    </button>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Register Faculty</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Phone number management
        document.getElementById('add-phone').addEventListener('click', function () {
            const container = document.getElementById('phone-numbers-container');
            const newInput = document.createElement('div');
            newInput.className = 'phone-number-container input-group mb-2';
            newInput.innerHTML = `
                <input type="text" class="form-control" name="phone_numbers[]" placeholder="Phone number">
                <button type="button" class="btn btn-outline-danger remove-phone">×</button>
            `;
            container.appendChild(newInput);
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-phone')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</body>

</html>