<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Faculty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
        }

        .form-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .phone-number-container {
            margin-bottom: 15px;
        }

        .add-phone-btn {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2 class="form-title">Edit Faculty Information</h2>

        <a href="{{ route('admin.faculties.view') }}" class="btn btn-secondary mb-4">← Back to List</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.faculties.update', $faculty->faculty_id) }}">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">University</label>
                    <input type="text" class="form-control" value="{{ $faculty->university->uni_name }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="dept_id" class="form-label">Department</label>
                    <select class="form-select" id="dept_id" name="dept_id" required>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->dept_id }}" {{ $dept->dept_id == $faculty->dept_id ? 'selected' : '' }}>
                                {{ $dept->dept_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                        value="{{ $faculty->first_name }}" required>
                </div>
                <div class="col-md-4">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name"
                        value="{{ $faculty->middle_name }}">
                </div>
                <div class="col-md-4">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                        value="{{ $faculty->last_name }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="designation" class="form-label">Designation</label>
                    <input type="text" class="form-control" id="designation" name="designation"
                        value="{{ $faculty->designation }}" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $faculty->email }}"
                        required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" class="form-control" id="qualification" name="qualification"
                        value="{{ $faculty->qualification }}" required>
                </div>
                <div class="col-md-6">
                    <label for="teaching_experience" class="form-label">Experience (years)</label>
                    <input type="number" class="form-control" id="teaching_experience" name="teaching_experience"
                        value="{{ $faculty->teaching_experience }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Numbers</label>
                <div id="phone-numbers-container">
                    @foreach($phoneNumbers as $phone)
                        <div class="phone-number-container input-group mb-2">
                            <input type="text" class="form-control" name="phone_numbers[]"
                                value="{{ $phone->phone_number }}" placeholder="Phone number">
                            <button type="button" class="btn btn-outline-danger remove-phone">×</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-phone" class="btn btn-outline-primary add-phone-btn">
                    + Add Another Phone Number
                </button>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Update Faculty</button>
            </div>
        </form>
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