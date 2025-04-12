<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Transcript Viewer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="/css/mod_transcript.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <a href="{{ route('admin_students_menu')}}" class="back-button">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>
                <h2>Student Transcript Viewer</h2>
                
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
                    <div id="paginationInfo" class="text-muted"></div>
                    <div id="paginationControls" class="btn-group"></div>
                </div>
            </div>
        </div>
        
        <!-- Transcript Modal -->
        <div class="modal fade" id="transcriptModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Student Transcript</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="transcriptContent">
                        <!-- Content will be loaded here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="printTranscriptBtn">Print Transcript</button>
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
                    url: "{{ route('admin_students.transcript.search') }}",
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
                                <button class="btn btn-sm btn-primary view-transcript-btn" 
                                    data-id="${student.student_id}">
                                    <i class="fas fa-file-alt"></i> View Transcript
                                </button>
                            </td>
                        </tr>
                    `);
                });

                // Attach transcript view event handlers
                $('.view-transcript-btn').click(function() {
                    const studentId = $(this).data('id');
                    loadTranscript(studentId);
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

            function loadTranscript(studentId) {
                $.ajax({
                    url: `/students/${studentId}/