<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Faculty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .back-btn {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="back-btn">
            <a href="{{ route('mod_users_menu') }}" class="btn btn-secondary">
                ← Back to Menu
            </a>
        </div>

        <div class="form-container">
            <h2 class="text-center mb-4">Edit Faculty Information</h2>

            <form method="POST" action="{{ route('faculties.update', $faculty->faculty_id) }}">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" 
                               value="{{ $faculty->first_name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" 
                               value="{{ $faculty->last_name }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="designation" class="form-label">Designation</label>
                    <input type="text" class="form-control" id="designation" name="designation" 
                           value="{{ $faculty->designation }}" required>
                </div>

                <div class="mb-3">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" class="form-control" id="qualification" name="qualification" 
                           value="{{ $faculty->qualification }}" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Update Faculty</button>
                </div>
            </form>

            @if(session('status'))
                <div class="alert alert-success mt-3">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>