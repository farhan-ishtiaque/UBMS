$(document).ready(function() {
    let currentPage = 1;
    let totalPages = 1;
    let selectedStudentId = null;

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

    // Handle pagination
    $(document).on('click', '.page-btn', function() {
        currentPage = $(this).data('page');
        searchStudents();
    });

    // Handle student selection
    $(document).on('change', 'input[name="studentRadio"]', function() {
        selectedStudentId = $(this).val();
        loadStudentData(selectedStudentId);
    });

    // Cancel update
    $('#cancelUpdate').click(function() {
        $('#updateFormSection').hide();
        $('input[name="studentRadio"]').prop('checked', false);
        selectedStudentId = null;
    });

    // Department dropdown change based on university
    $('#uni_id').change(function() {
        const universityId = $(this).val();
        if (universityId) {
            $.get(`/departments/by-university/${universityId}`, function(data) {
                const deptSelect = $('#dept_id');
                deptSelect.empty().append('<option value="">Select a Department</option>');
                data.forEach(dept => {
                    deptSelect.append(`<option value="${dept.dept_id}">${dept.dept_name}</option>`);
                });
                
                // If we have a selected student, try to set their department again
                if (selectedStudentId) {
                    loadStudentData(selectedStudentId);
                }
            });
        } else {
            $('#dept_id').empty().append('<option value="">Select a Department</option>');
        }
    });

    // Form submission
    $('#updateStudentForm').submit(function(e) {
        e.preventDefault();
        
        if (!selectedStudentId) {
            alert('Please select a student first');
            return;
        }
        
        // Show loading state
        $('#updateFormSection').hide();
        $('#loadingIndicator').show();
        
        $.ajax({
            url: `/moderator/dashboard/mod_students_menu/students-update/update/${selectedStudentId}`,
            type: 'PUT',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                searchStudents(); // Refresh the search results
            },
            error: function(xhr) {
                let errorMsg = 'Error updating student';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg += ': ' + xhr.responseJSON.message;
                }
                alert(errorMsg);
            },
            complete: function() {
                $('#loadingIndicator').hide();
                $('#updateFormSection').show();
            }
        });
    });

    function searchStudents() {
        const searchTerm = $('#searchInput').val();
        
        // Show loading state
        $('#resultsBody').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');
        $('#paginationControls').empty();
        
        $.ajax({
            url: '/moderator/dashboard/mod_students_menu/students-update/update/search',
            type: 'POST',
            data: {
                search: searchTerm,
                page: currentPage
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                displayResults(response);
            },
            error: function(xhr) {
                $('#resultsBody').html('<tr><td colspan="6" class="text-center">Error loading results</td></tr>');
                console.error('Search error:', xhr.responseText);
            }
        });
    }

    function displayResults(data) {
        const resultsBody = $('#resultsBody');
        resultsBody.empty();
        
        if (data.data.length === 0) {
            resultsBody.append('<tr><td colspan="6" class="text-center">No students found</td></tr>');
            return;
        }
        
        data.data.forEach(student => {
            const row = `
                <tr>
                    <td><input type="radio" name="studentRadio" value="${student.student_id}" ${selectedStudentId == student.student_id ? 'checked' : ''}></td>
                    <td>${student.first_name} ${student.last_name}</td>
                    <td>${student.email}</td>
                    <td>${student.university ? student.university.uni_name : 'N/A'}</td>
                    <td>${student.department ? student.department.dept_name : 'N/A'}</td>
                    <td>
                        <span class="status-badge ${student.graduation_status === 'graduated' ? 'graduated' : 'not-graduated'}">
                            ${student.graduation_status === 'graduated' ? 'Graduated' : 'Not Graduated'}
                        </span>
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
        
        if (totalPages <= 1) return;
        
        // Previous button
        if (currentPage > 1) {
            paginationControls.append(`<button class="page-btn" data-page="${currentPage - 1}">Previous</button>`);
        }
        
        // Page numbers
        const startPage = Math.max(1, currentPage - 2);
        const endPage = Math.min(totalPages, currentPage + 2);
        
        for (let i = startPage; i <= endPage; i++) {
            const activeClass = i === currentPage ? 'active' : '';
            paginationControls.append(`<button class="page-btn ${activeClass}" data-page="${i}">${i}</button>`);
        }
        
        // Next button
        if (currentPage < totalPages) {
            paginationControls.append(`<button class="page-btn" data-page="${currentPage + 1}">Next</button>`);
        }
        
        // Pagination info
        $('#paginationInfo').text(`Page ${currentPage} of ${totalPages} • ${data.total} students found`);
    }

    async function loadStudentData(studentId) {
        try {
            // Show loading state
            $('#updateFormSection').hide();
            $('#loadingIndicator').show();
            
            // 1. First fetch the student data
            const studentResponse = await $.get(`/moderator/dashboard/mod_students_menu/students-update/update/${studentId}`);
            const student = studentResponse;
            
            // 2. Fill all non-dependent fields
            $('#student_id').val(student.student_id);
            $('#first_name').val(student.first_name);
            $('#last_name').val(student.last_name);
            $('#email').val(student.email);
            $('#phone_number').val(student.phone_number);
            $('#address').val(student.address);
            $('#gender').val(student.gender);
            $('#date_of_birth').val(formatDateForInput(student.date_of_birth));
            $('#cgpa').val(student.cgpa);
            $('#graduation_status').val(student.graduation_status);
            
            // 3. Set university and load departments
            $('#uni_id').val(student.uni_id);
            
            if (student.uni_id) {
                // 4. Fetch departments for this university
                const deptResponse = await $.get(`/departments/by-university/${student.uni_id}`);
                const deptSelect = $('#dept_id');
                
                // Clear and repopulate departments
                deptSelect.empty().append('<option value="">Select a Department</option>');
                deptResponse.forEach(dept => {
                    deptSelect.append(`<option value="${dept.dept_id}">${dept.dept_name}</option>`);
                });
                
                // 5. Set the department after options are populated
                if (student.dept_id) {
                    // Small delay to ensure options are rendered
                    setTimeout(() => {
                        deptSelect.val(student.dept_id);
                    }, 100);
                }
            } else {
                $('#dept_id').empty().append('<option value="">Select a Department</option>');
            }
            
            // 6. Finally show the form
            $('#updateFormSection').show();
        } catch (error) {
            console.error('Error loading student:', error);
            alert('Failed to load student data');
        } finally {
            $('#loadingIndicator').hide();
        }
    }
    
    // Helper function to format date for input[type="date"]
    function formatDateForInput(dateString) {
        if (!dateString) return '';
        
        // If date is already in YYYY-MM-DD format
        if (/^\d{4}-\d{2}-\d{2}$/.test(dateString)) {
            return dateString;
        }
        
        // If date comes as d/m/Y format
        if (/^\d{2}\/\d{2}\/\d{4}$/.test(dateString)) {
            const [day, month, year] = dateString.split('/');
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
        }
        
        // For other formats (like from database)
        const date = new Date(dateString);
        if (isNaN(date.getTime())) return '';
        
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        
        return `${year}-${month}-${day}`;
    }
});