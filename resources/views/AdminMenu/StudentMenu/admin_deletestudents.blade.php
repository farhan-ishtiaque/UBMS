<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Transcript Viewer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mod_transcript.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <a href="{{ route('admin_students_menu')}}" class="back-button">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>
                <h2>Delete Students</h2>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by name or email...">
                    </div>
                    <div class="col-md-4">
                        <select id="departmentFilter" class="form-control">
                            <option value="">All Departments</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->dept_id }}">{{ $department->dept_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button id="searchBtn" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="resultsBody">
                            <tr>
                                <td colspan="6" class="text-center">Use the search above to find students</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div id="paginationInfo" class="pagination-info"></div>
                    <div id="paginationControls" class="btn-group"></div>
                </div>
            </div>
        </div>
        
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Deletion</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this student record? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Search function
            $('#searchBtn').click(function() {
                performSearch();
            });

            // Also search when pressing Enter in search field
            $('#searchInput').keypress(function(e) {
                if (e.which == 13) {
                    performSearch();
                }
            });

            // Department filter change
            $('#departmentFilter').change(function() {
                performSearch();
            });

            function performSearch() {
                const search = $('#searchInput').val();
                const departmentId = $('#departmentFilter').val();
                
                $.ajax({
                    url: "{{ route('uni_students.search') }}",
                    type: "GET",
                    data: {
                        search: search,
                        department_id: departmentId
                    },
                    success: function(response) {
                        updateResultsTable(response);
                        updatePaginationControls(response);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function updateResultsTable(data) {
                const $tbody = $('#resultsBody');
                $tbody.empty();

                if (data.data.length === 0) {
                    $tbody.append('<tr><td colspan="6" class="text-center">No students found</td></tr>');
                    return;
                }

                data.data.forEach(student => {
                    const fullName = `${student.first_name} ${student.last_name}`;
                    const status = student.graduation_status === 'graduated' ? 
                        '<span class="badge bg-success">Graduated</span>' : 
                        '<span class="badge bg-warning text-dark">Not Graduated</span>';

                    $tbody.append(`
                        <tr>
                            <td><input type="checkbox" class="student-checkbox" value="${student.student_id}"></td>
                            <td>${fullName}</td>
                            <td>${student.email}</td>
                            <td>${student.department ? student.department.dept_name : 'N/A'}</td>
                            <td>${status}</td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="${student.student_id}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    `);
                });

                // Attach delete event handlers
                $('.delete-btn').click(function() {
                    const studentId = $(this).data('id');
                    $('#confirmDeleteModal').data('studentId', studentId).modal('show');
                });
            }

            function updatePaginationControls(data) {
                const $paginationInfo = $('#paginationInfo');
                const $paginationControls = $('#paginationControls');
                
                $paginationInfo.empty();
                $paginationControls.empty();

                if (data.total > 0) {
                    $paginationInfo.text(`Showing ${data.from} to ${data.to} of ${data.total} students`);
                    
                    // Previous button
                    const prevDisabled = data.prev_page_url ? '' : 'disabled';
                    $paginationControls.append(`
                        <button class="btn btn-outline-primary page-btn" ${prevDisabled} 
                            data-url="${data.prev_page_url || '#'}">
                            Previous
                        </button>
                    `);

                    // Next button
                    const nextDisabled = data.next_page_url ? '' : 'disabled';
                    $paginationControls.append(`
                        <button class="btn btn-outline-primary page-btn" ${nextDisabled} 
                            data-url="${data.next_page_url || '#'}">
                            Next
                        </button>
                    `);

                    // Page button click handler
                    $('.page-btn').click(function() {
                        if (!$(this).is(':disabled')) {
                            const url = $(this).data('url');
                            $.ajax({
                                url: url,
                                type: "GET",
                                success: function(response) {
                                    updateResultsTable(response);
                                    updatePaginationControls(response);
                                },
                                error: function(xhr) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                }
            }

            // Confirm delete
            $('#confirmDeleteBtn').click(function() {
                const studentId = $('#confirmDeleteModal').data('studentId');
                const $modal = $('#confirmDeleteModal');
                
                $.ajax({
                    url: `/students/${studentId}`,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $modal.modal('hide');
                            performSearch(); // Refresh the results
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        $modal.modal('hide');
                    }
                });
            });
        });
    </script>
</body>
</html>