<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Faculty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
        }
        .confirmation-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            text-align: center;
        }
        .faculty-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h2>Delete Faculty</h2>
        
        <a href="{{ route('admin.faculties.view') }}" class="btn btn-secondary mb-4">← Back to List</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="faculty-info">
            <h4>{{ $faculty->first_name }} {{ $faculty->last_name }}</h4>
            <p><strong>Email:</strong> {{ $faculty->email }}</p>
            <p><strong>Designation:</strong> {{ $faculty->designation }}</p>
            <p><strong>Department:</strong> {{ $faculty->department->dept_name }}</p>
        </div>

        <p class="text-danger">Are you sure you want to delete this faculty member? This action cannot be undone.</p>

        <form method="POST" action="{{ route('admin.faculties.destroy', $faculty->faculty_id) }}">
            @csrf
            @method('DELETE')
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a href="{{ route('admin.faculties.view') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>