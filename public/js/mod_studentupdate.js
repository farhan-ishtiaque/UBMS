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
            url: "{{ route('admin_students.update.get', ['id' => '__ID__']) }}".replace('__ID__', studentId),
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
            url: "{{ route('admin_students.update.submit', ['id' => '__ID__']) }}".replace('__ID__', studentId),
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