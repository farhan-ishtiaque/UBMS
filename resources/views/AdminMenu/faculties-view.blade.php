<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculties List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
        .heading {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 32px;
        }
        .action-btn {
            margin: 0 3px;
        }

        .back-button {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
    border-radius: var(--border-radius);
    background-color: rgba(67, 97, 238, 0.1);
    transition: var(--transition);
    text-decoration: none;
    font-weight: 500;
}

.back-button:hover {
    background-color: rgba(67, 97, 238, 0.2);
    text-decoration: none;
    color: var(--secondary-color);
    transform: translateY(-1px);
}

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            text-align: left;
            padding: 14px 16px;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #f0f0f0;
            color: #555;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .pagination {
            margin-top: 20px;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('uniAdmin.dashboard')}}" class="back-button">
            <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
        </a>
        <h1 class="heading">Faculties List</h1>
        
        <div class="mb-4">
            <a href="{{ route('admin.faculties.register') }}" class="btn btn-primary">Register New Faculty</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faculties as $faculty)
                    <tr>
                        <td>{{ $faculty->faculty_id }}</td>
                        <td>{{ $faculty->first_name }} {{ $faculty->last_name }}</td>
                        <td>{{ $faculty->email }}</td>
                        <td>{{ $faculty->designation }}</td>
                        <td>{{ $faculty->dept_name }}</td>
                        <td>
                            
                            <a href="{{ route('admin.faculties.delete', $faculty->faculty_id) }}" 
                               class="btn btn-sm btn-outline-danger action-btn">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $faculties->links() }}
        </div>
    </div>
</body>
</html>