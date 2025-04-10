
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Faculty</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/faculty.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #e6f2ff;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.2);
        }

        .btn-blue {
            background-color: #007bff;
            color: white;
        }

        .btn-blue:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="form-container mx-auto col-md-8">
        <h2 class="text-center text-primary mb-4">Register Faculty</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('faculties.store') }}">
            @csrf

            <div class="mb-3">
                <label for="dept_id" class="form-label">Department ID</label>
                <input type="number" class="form-control" name="dept_id" required>
            </div>

            <div class="mb-3">
                <label for="uni_id" class="form-label">University ID</label>
                <input type="number" class="form-control" name="uni_id" required>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" required>
            </div>

            <div class="mb-3">
                <label for="middle_name" class="form-label">Middle Name</label>
                <input type="text" class="form-control" name="middle_name">
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" required>
            </div>

            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" class="form-control" name="designation" required>
            </div>

            <div class="mb-3">
                <label for="qualification" class="form-label">Qualification</label>
                <input type="text" class="form-control" name="qualification" required>
            </div>

            <div class="mb-3">
                <label for="teaching_experience" class="form-label">Teaching Experience (Years)</label>
                <input type="number" class="form-control" name="teaching_experience">
            </div>



            <div class="mb-3">
                <label class="form-label">Phone Numbers</label>
                <div id="phone-fields">
                    <div class="input-group mb-2">
                        <input type="text" name="phone_numbers[]" class="form-control" placeholder="Enter phone number">
                        <button type="button" class="btn btn-outline-secondary remove-phone">X</button>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-blue" id="add-phone">Add Phone</button>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>

<!-- JS to handle phone inputs -->
<script>
    document.getElementById('add-phone').addEventListener('click', function () {
        const phoneFields = document.getElementById('phone-fields');
        const div = document.createElement('div');
        div.classList.add('input-group', 'mb-2');
        div.innerHTML = `
            <input type="text" name="phone_numbers[]" class="form-control" placeholder="Enter phone number">
            <button type="button" class="btn btn-outline-secondary remove-phone">X</button>
        `;
        phoneFields.appendChild(div);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-phone')) {
            e.target.parentElement.remove();
        }
    });
</script>
</body>
</html>
