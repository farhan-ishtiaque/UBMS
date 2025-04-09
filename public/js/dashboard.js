document.addEventListener('DOMContentLoaded', function () {
    fetch('/dashboard-data')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data); // Debug log
            document.getElementById('total-universities').textContent = data.totalUniversities || '0';
            document.getElementById('public-universities').textContent = data.publicUniversities || '0';
            document.getElementById('private-universities').textContent = data.privateUniversities || '0';
            document.getElementById('total-faculties').textContent = data.totalFaculties || '0';
            document.getElementById('public-faculties').textContent = data.publicFaculties || '0';
            document.getElementById('private-faculties').textContent = data.privateFaculties || '0';
            document.getElementById('total-students').textContent = data.totalStudents || '0';
            document.getElementById('public-students').textContent = data.publicStudents || '0';
            document.getElementById('private-students').textContent = data.privateStudents || '0';
            document.getElementById('job-postings').textContent = data.jobPostings || '0';
            document.getElementById('faculty-programs').textContent = data.facultyPrograms || '0';

        })
        .catch(error => {
            console.error('Fetch error:', error);
            // Update all cards to show error
            document.querySelectorAll('.card-value').forEach(el => {
                el.textContent = 'Error';
            });
        });
});