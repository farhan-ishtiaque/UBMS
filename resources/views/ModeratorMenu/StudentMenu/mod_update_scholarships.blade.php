<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Scholarship Management | Premium Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/mod_update_scholarships.css') }}">
</head>

<body class="bg-light">

    <div class="container mt-4">
        <!-- Header with Back Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('mod_students_menu')}}" class="back-button">
                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
            </a>
            <h2 class="mb-0">Scholarship Status Management</h2>
            <div></div> <!-- Empty div for alignment -->
        </div>

        <!-- Filter Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{route('mod_update_scholarships')}}">
                    <div class="form-row">
                        <!-- University Filter -->
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted mb-1">University</label>
                            <select name="university_id" class="form-control">
                                <option value="">All Universities</option>
                                @foreach($universities as $university)
                                    <option value="{{ $university->uni_id }}" {{ request('university_id') == $university->uni_id ? 'selected' : '' }}>
                                        {{ $university->uni_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Department Filter -->
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted mb-1">Department</label>
                            <select name="department_id" class="form-control">
                                <option value="">All Departments</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->dept_id }}" {{ request('department_id') == $department->dept_id ? 'selected' : '' }}>
                                        {{ $department->dept_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Scholarship Status Filter -->
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted mb-1">Status</label>
                            <select name="scholarship_status" class="form-control">
                                <option value="">All Status</option>
                                <option value="Recepient" {{ request('scholarship_status') == 'Recepient' ? 'selected' : '' }}>Recipient</option>
                                <option value="Revoked" {{ request('scholarship_status') == 'Revoked' ? 'selected' : '' }}>Revoked</option>
                            </select>
                        </div>

                        <!-- Search Field -->
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted mb-1">Search</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Name/Email"
                                    value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-filter mr-2"></i> Apply Filters
                            </button>
                            <a href="{{ route('mod_update_scholarships') }}" class="btn btn-light px-4 ml-2">
                                <i class="fas fa-sync-alt mr-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Scholarship Table Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>University</th>
                                <th>Department</th>
                                <th>Current Status</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($scholarships as $scholarship)
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ $scholarship->student->first_name ?? 'N/A' }} 
                                        {{ $scholarship->student->last_name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $scholarship->student->email ?? '#' }}" class="text-primary">
                                            {{ $scholarship->student->email ?? 'N/A' }}
                                        </a>
                                    </td>
                                    <td>{{ $scholarship->student->university->uni_name ?? 'N/A' }}</td>
                                    <td>{{ $scholarship->student->department->dept_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $scholarship->status == 'Recepient' ? 'badge-success' : 'badge-danger' }}">
                                            <i class="fas fa-{{ $scholarship->status == 'Recepient' ? 'check-circle' : 'times-circle' }} mr-1"></i>
                                            {{ $scholarship->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-dark">{{ $scholarship->scholarship_type }}</span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('mod_update_scholarship_status', $scholarship->scholarship_id) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <div class="input-group">
                                                <select name="status" class="form-control form-control-sm">
                                                    <option value="Recepient" {{ $scholarship->status == 'Recepient' ? 'selected' : '' }}>Recipient</option>
                                                    <option value="Revoked" {{ $scholarship->status == 'Revoked' ? 'selected' : '' }}>Revoked</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-save"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">No scholarship records found</h5>
                                            <p class="text-muted small">Try adjusting your filters</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination Footer -->
            <div class="card-footer bg-white border-0 py-3">
                {{ $scholarships->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif
    
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}'
        });
    </script>
    @endif
</body>

</html>