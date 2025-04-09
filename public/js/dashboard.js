// Simulate fetching data from an API or database when the document content is loaded
/*document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
      // These values could be dynamically fetched from your backend
      document.getElementById('total-universities').textContent = '142';
      document.getElementById('public-universities').textContent = '87';
      document.getElementById('private-universities').textContent = '55';
      document.getElementById('total-faculties').textContent = '5,243';
      document.getElementById('public-faculties').textContent = '3,120';
      document.getElementById('private-faculties').textContent = '2,123';
      document.getElementById('total-students').textContent = '342,891';
      document.getElementById('public-students').textContent = '210,456';
      document.getElementById('private-students').textContent = '132,435';
      document.getElementById('job-postings').textContent = '243';
      document.getElementById('faculty-programs').textContent = '56';
    }, 1000);
  });

  document.addEventListener('DOMContentLoaded', function() {
    fetch('/dashboard-data')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-universities').textContent = data.totalUniversities;
            document.getElementById('public-universities').textContent = data.publicUniversities;
            document.getElementById('private-universities').textContent = data.privateUniversities;
            // Update other cards similarly
        });
});*/

document.addEventListener('DOMContentLoaded', function() {
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