<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student Information</title>
    <link rel="stylesheet" href="{{ asset('css/mod_updatestudents.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="back-btn-container">
            <a href="{{ route('admin_students_menu') }}" class="back-btn">← Back</a>
        </div>

        <h2>Update Student Information - {{ $university->uni_name }}</h2>

        <div class="search-section">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search by name or email...">
                <button id="searchBtn"><i class="fas fa-search"></i> Search</button>
            </div>
            
            <div class="results-container">
                <div class="results-header">
                    <h3>Search Results</h3>
                    <div class="pagination-info" id="paginationInfo"></div>
                </div>
                <div class="results-table-container">
                    <table class="results-table">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="resultsBody">
                            <!-- Results will be populated here -->
                        </tbody>
                    </table>
                </div>
                <div class="pagination-controls" id="paginationControls"></div>
            </div>
        </div>

        <div class="update-form-section" id="updateFormSection" style="display: none;">
            <h3>Update Student Information</h3>
            <form id="updateStudentForm">
                <input type="hidden" id="student_id" name="student_id">
                <input type="hidden" id="uni_id" name="uni_id" value="{{ $university->uni_id }}">
                
                <div class="form-group">
                    <label>University</label>
                    <input type="text" value="{{ $university->uni_name }}" readonly class="form-control">
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

                <!-- [Rest of the form fields remain the same] -->
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
    // Search function
    $('#searchBtn').click(function() {
        const search = $('#searchInput').val();
        $.ajax({
            url: "{{ route('admin_students.update.search') }}",
            type: "GET",
            data: { search: search },
            success: function(response) {
                updateResultsTable(response);
                updatePaginationControls(response);
            },
            error: function(xhr) {
                console.error('Search error:', xhr.responseText);
                $('#resultsBody').html('<tr><td colspan="5" class="text-center">Error loading results</td></tr>');
            }
        });
    });

    function updateResultsTable(data) {
        const $tbody = $('#resultsBody');
        $tbody.empty();

        if (data.data.length === 0) {
            $tbody.append('<tr><td colspan="5" class="text-center">No students found</td></tr>');
            return;
        }

        data.data.forEach(student => {
            const status = student.graduation_status === 'graduated' ? 
                '<span class="badge bg-success">Graduated</span>' : 
                '<span class="badge bg-warning text-dark">Not Graduated</span>';

            $tbody.append(`
                <tr>
                    <td><button class="btn btn-sm btn-primary select-btn" data-id="${student.student_id}">Select</button></td>
                    <td>${student.first_name} ${student.last_name}</td>
                    <td>${student.email}</td>
                    <td>${student.department?.dept_name || 'N/A'}</td>
                    <td>${status}</td>
                </tr>
            `);
        });

        $('.select-btn').click(function() {
            const studentId = $(this).data('id');
            loadStudent(studentId);
        });
    }

    function loadStudent(studentId) {
        $.ajax({
            url: "{{ route('admin_students.update.get', '') }}/" + studentId,
            type: "GET",
            success: function(response) {
                populateForm(response);
                $('#updateFormSection').show();
                $('html, body').animate({
                    scrollTop: $('#updateFormSection').offset().top
                }, 500);
            },
            error: function(xhr) {
                console.error('Error loading student:', xhr.responseText);
                alert('Failed to load student data');
            }
        });
    }

    function populateForm(student) {
        $('#student_id').val(student.student_id);
        $('#dept_id').val(student.dept_id);
        $('#first_name').val(student.first_name);
        $('#last_name').val(student.last_name);
        $('#email').val(student.email);
        $('#phone_number').val(student.phone_number);
        $('#address').val(student.address);
        $('#gender').val(student.gender);
        $('#date_of_birth').val(student.date_of_birth);
        $('#cgpa').val(student.cgpa);
        $('#graduation_status').val(student.graduation_status);
    }

    $('#updateStudentForm').submit(function(e) {
        e.preventDefault();
        const studentId = $('#student_id').val();
        
        $.ajax({
            url: "{{ route('admin_students.update.submit', '') }}/" + studentId,
            type: "PUT",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                $('#searchBtn').click();
                $('#updateFormSection').hide();
            },
            error: function(xhr) {
                console.error('Error updating student:', xhr.responseText);
                alert('Error updating student');
            }
        });
    });

    $('#cancelUpdate').click(function() {
        $('#updateFormSection').hide();
    });

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
});