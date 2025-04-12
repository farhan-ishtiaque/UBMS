$(document).ready(function() {
    let currentPage = 1;
    let totalPages = 1;

    // Safely initialize Bootstrap modal
    const initModal = () => {
        const modalEl = document.getElementById('transcriptModal');
        if (!modalEl) {
            console.error('Modal element not found!');
            return null;
        }
        return new bootstrap.Modal(modalEl);
    };

    const transcriptModal = initModal();
    
    if (!transcriptModal) {
        console.error('Failed to initialize modal');
        return;
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

    // Handle view transcript button click
    $(document).on('click', '.view-transcript-btn', function() {
        const studentId = $(this).data('id');
        loadTranscript(studentId);
    });

    // Print transcript button
    $('#printTranscriptBtn').click(function() {
        window.print();
    });

    // Modal close handlers
    $(document).on('click', '[data-bs-dismiss="modal"], .btn-secondary', function() {
        transcriptModal.hide();
    });

    // Escape key to close modal
    $(document).keydown(function(e) {
        const modalElement = document.getElementById('transcriptModal');
        if (e.key === "Escape" && modalElement.classList.contains('show')) {
            transcriptModal.hide();
        }
    });

    function searchStudents() {
        const searchTerm = $('#searchInput').val();
        const universityId = $('#universityFilter').val();
        const departmentId = $('#departmentFilter').val();
        
        $('#resultsBody').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
        $('#paginationControls').empty();
        
        $.ajax({
            url: '/moderator/dashboard/mod_students_menu/students-transcript/search',
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
                        <button class="btn btn-sm btn-primary view-transcript-btn" data-id="${student.student_id}">
                            <i class="fas fa-file-alt"></i> View Transcript
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
        
        if (totalPages <= 1) return;
        
        // Previous button
        if (currentPage > 1) {
            paginationControls.append(`<button class="btn btn-sm btn-outline-primary page-btn mr-1" data-page="${currentPage - 1}">
                <i class="fas fa-chevron-left"></i> Previous
            </button>`);
        }
        
        // Page numbers
        const startPage = Math.max(1, currentPage - 2);
        const endPage = Math.min(totalPages, currentPage + 2);
        
        for (let i = startPage; i <= endPage; i++) {
            const activeClass = i === currentPage ? 'btn-primary' : 'btn-outline-primary';
            paginationControls.append(`<button class="btn btn-sm ${activeClass} page-btn mx-1" data-page="${i}">${i}</button>`);
        }
        
        // Next button
        if (currentPage < totalPages) {
            paginationControls.append(`<button class="btn btn-sm btn-outline-primary page-btn ml-1" data-page="${currentPage + 1}">
                Next <i class="fas fa-chevron-right"></i>
            </button>`);
        }
        
        // Pagination info
        $('#paginationInfo').text(`Showing ${data.from} to ${data.to} of ${data.total} students`);
    }

    function loadTranscript(studentId) {
        $('#transcriptContent').html('<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
        transcriptModal.show();
        
        $.ajax({
            url: `/moderator/dashboard/mod_students_menu/students-transcript/${studentId}`,
            type: 'GET',
            success: function(response) {
                renderTranscript(response);
            },
            error: function(xhr) {
                $('#transcriptContent').html('<div class="alert alert-danger">Error loading transcript</div>');
                console.error('Transcript error:', xhr.responseText);
            }
        });
    }

    function renderTranscript(data) {
        const student = data.student;
        const transcript = data.transcript;
        
        let html = `
            <div class="transcript-header text-center mb-4">
                <h3>${student.university.uni_name}</h3>
                <h4>Official Academic Transcript</h4>
            </div>
            
            <div class="student-info mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Student Name:</strong> ${student.first_name} ${student.middle_name ? student.middle_name + ' ' : ''}${student.last_name}</p>
                        <p><strong>Student ID:</strong> ${student.student_id}</p>
                        <p><strong>Department:</strong> ${student.department.dept_name}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email:</strong> ${student.email}</p>
                        <p><strong>Status:</strong> <span class="status-badge ${student.graduation_status === 'graduated' ? 'graduated' : 'not-graduated'}">
                            ${student.graduation_status === 'graduated' ? 'Graduated' : 'Not Graduated'}
                        </span></p>
                        <p><strong>CGPA:</strong> ${student.cgpa || 'N/A'}</p>
                    </div>
                </div>
            </div>
        `;
        
        // Add each semester's courses
        for (const [semester, courses] of Object.entries(transcript)) {
            html += `
                <div class="semester-section mb-4">
                    <h5 class="bg-light p-2">${semester}</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Credits</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
            `;
            
            let semesterCredits = 0;
            
            courses.forEach(course => {
                const grade = course.pivot.grade || 'N/A';
                const credits = course.credits || 0;
                
                html += `
                    <tr>
                        <td>${course.course_code}</td>
                        <td>${course.course_name}</td>
                        <td>${credits}</td>
                        <td>${grade}</td>
                    </tr>
                `;
                
                semesterCredits += credits;
            });
            
            html += `
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-right"><strong>Semester Total:</strong></td>
                                <td><strong>${semesterCredits}</strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            `;
        }
        
        $('#transcriptContent').html(html);
    }
});