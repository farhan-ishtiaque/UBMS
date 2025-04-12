document.addEventListener('DOMContentLoaded', function() {
    fetch('/dashboard-data2')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data); // For debugging

            const updateValue = (id, value) => {
                const el = document.getElementById(id);
                if (el) {
                    el.textContent = value || '0';
                } else {
                    console.warn(`Element with id '${id}' not found`);
                }
            };

            updateValue('total-departments', data.totalDepartments);
            updateValue('total-faculties', data.totalFaculties);
            updateValue('total-students', data.totalStudents);
            updateValue('total-courses', data.totalCourses);
            updateValue('job-postings', data.jobPostings);
            updateValue('faculty-recruitment', data.facultyRecruitment);
            updateValue('faculty-programs', data.facultyPrograms);
            updateValue('faculty-development', data.facultyRecruitment);
        })
        .catch(error => {
            console.error('Fetch error:', error);
            document.querySelectorAll('.card-value').forEach(el => {
                if (el.textContent === 'Loading...') {
                    el.textContent = 'Error';
                }
            });
        });
});
