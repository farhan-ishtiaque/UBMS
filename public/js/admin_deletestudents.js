$(document).ready(function() {
    let currentPage = 1;
    let totalPages = 1;
    let selectedStudentId = null;

    // Initialize the page
    function initPage() {
        searchStudents();
    }

    // Search for students
    $('#searchBtn').click(function() {
        currentPage = 1;
        searchStudents();
    });

    $('#searchInput').keypress(function(e) {
        if (e.which === 13) {
            currentPage = 1;
            searchStudents();
        }
    });

    // University filter change
    $('#universityFilter').change(function() {
        const universityId = $(this).val();
        const deptSelect = $('#departmentFilter');
        
        deptSelect.empty().append('<option value="">All Departments</option>');
        
        if (universityId) {
            $.get(`/departments/by-university/${universityId}`, function(data) {
                data.forEach(dept => {
                    deptSelect.append(`<option value="${dept.dept_id}">${dept.dept_name}</option>`);
                });
                currentPage = 1;
                searchStudents();
            }).fail(function(xhr) {
                console.error('Error loading departments:', xhr.responseText);
            });
        } else {
            currentPage = 1;
            searchStudents();
        }
    });

    // Department filter change
    $('#departmentFilter').change(function() {
        currentPage = 1;
        searchStudents();
    });

    // Handle pagination
    $(document).on('click', '.page-btn', function() {
        currentPage = $(this).data('page');
        searchStudents();
    });

    // Handle delete button click
    $(document).on('click', '.delete-btn', function() {
        selectedStudentId = $(this).data('id');
        $('#confirmDeleteModal').modal('show');
    });

    // Confirm deletion
    $('#confirmDeleteBtn').click(function() {
        if (!selectedStudentId) return;
        
        $.ajax({
            url: `/uni-admin/dashboard/admin_students_menu/students-delete/${selectedStudentId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    $('#confirmDeleteModal').modal('hide');
                    searchStudents();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
            }
        });
    });

    function searchStudents() {
        const searchTerm = $('#searchInput').val();
        const universityId = $('#universityFilter').val();
        const departmentId = $('#departmentFilter').val();
        
        $('#resultsBody').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
        $('#paginationControls').empty();
        
        $.ajax({
            url: '/uni-admin/dashboard/admin_students_menu/students-delete/search',
            type: 'POST',
            data: {
                search: searchTerm,
                university_id: universityId,
                department_id: departmentId,
                page: currentPage
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                displayResults(response);
            },
            error: function(xhr) {
                $('#resultsBody').html('<tr><td colspan="7" class="text-center">Error loading results</td></tr>');
                console.error('Search error:', xhr.responseText);
            }
        });
    }

    function displayResults(data) {
        const resultsBody = $('#resultsBody');
        resultsBody.empty();
        
        if (data.data.length === 0) {
            resultsBody.append('<tr><td colspan="7" class="text-center">No students found</td></tr>');
            return;
        }
        
        data.data.forEach(student => {
            const row = `
                <tr>
                    <td><input type="radio" name="studentRadio" value="${student.student_id}"></td>
                    <td>${student.first_name} ${student.last_name}</td>
                    <td>${student.email}</td>
                    <td>${student.university ? student.university.uni_name : 'N/A'}</td>
                    <td>${student.department ? student.department.dept_name : 'N/A'}</td>
                    <td>
                        <span class="status-badge ${student.graduation_status === 'graduated' ? 'graduated' : 'not-graduated'}">
                            ${student.graduation_status === 'graduated' ? 'Graduated' : 'Not Graduated'}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${student.student_id}">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </td>
                </tr>
            `;
            resultsBody.append(row);
        });
        
        updatePagination(data);
    }

    function updatePagination(data) {
        currentPage = data.current_page;
        totalPages = data.last_page;
        
        const paginationControls = $('#paginationControls');
        paginationControls.empty();
        
        if (totalPages <= 1) {
            $('#paginationInfo').text(`Showing ${data.from} to ${data.to} of ${data.total} students`);
            return;
        }
        
        // Previous button
        if (currentPage > 1) {
            paginationControls.append(`<button class="btn btn-sm btn-outline-primary page-btn" data-page="${currentPage - 1}">
                <i class="fas fa-chevron-left"></i>
            </button>`);
        }
        
        // Page numbers
        const startPage = Math.max(1, currentPage - 2);
        const endPage = Math.min(totalPages, currentPage + 2);
        
        if (startPage > 1) {
            paginationControls.append(`<button class="btn btn-sm btn-outline-primary page-btn" data-page="1">1</button>`);
            if (startPage > 2) {
                paginationControls.append(`<span class="btn btn-sm btn-outline-primary disabled">...</span>`);
            }
        }
        
        for (let i = startPage; i <= endPage; i++) {
            const activeClass = i === currentPage ? 'btn-primary' : 'btn-outline-primary';
            paginationControls.append(`<button class="btn btn-sm ${activeClass} page-btn" data-page="${i}">${i}</button>`);
        }
        
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                paginationControls.append(`<span class="btn btn-sm btn-outline-primary disabled">...</span>`);
            }
            paginationControls.append(`<button class="btn btn-sm btn-outline-primary page-btn" data-page="${totalPages}">${totalPages}</button>`);
        }
        
        // Next button
        if (currentPage < totalPages) {
            paginationControls.append(`<button class="btn btn-sm btn-outline-primary page-btn" data-page="${currentPage + 1}">
                <i class="fas fa-chevron-right"></i>
            </button>`);
        }
        
        // Pagination info
        $('#paginationInfo').text(`Showing ${data.from} to ${data.to} of ${data.total} students`);
    }

    // Initialize the page
    initPage();
});