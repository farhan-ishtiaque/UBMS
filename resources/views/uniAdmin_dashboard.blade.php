<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UBMS Dashboard</title>
  <!-- Link to external CSS and Font Awesome icons -->
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo-container">
      <i class="fas fa-university logo-icon"></i>
      <span class="logo-text">UBMS</span>
    </div>
    <ul class="menu">
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-chalkboard-teacher"></i> Faculties</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-user-graduate"></i> Students</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-building"></i> Departments</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-book"></i> Courses</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-briefcase"></i> Job Postings</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-user-tie"></i> Faculty Recruitment</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-chalkboard"></i> Faculty Development</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-money-check-alt"></i> University Fundings</a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <div class="header">
      <h1 class="page-title">Dashboard Overview</h1>
      <div class="user-profile">
        <img src="{{ asset('images/Moderator.png') }}" alt="User" class="user-avatar" />
        <span class="username">Moderator</span>
      </div>
    </div>

    <div class="card-grid">
      <!-- Departments Card -->
      <div class="card card-1">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-building"></i></div>
          <h3 class="card-title">Total Departments</h3>
        </div>
        <div class="card-value" id="total-departments">Loading...</div>
      </div>

      <!-- Faculties Card -->
      <div class="card card-2">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
          <h3 class="card-title">Total Faculties</h3>
        </div>
        <div class="card-value" id="total-faculties">Loading...</div>
      </div>

      <!-- Students Card -->
      <div class="card card-3">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-users"></i></div>
          <h3 class="card-title">Total Students</h3>
        </div>
        <div class="card-value" id="total-students">Loading...</div>
      </div>

      <!-- Courses Card -->
      <div class="card card-4">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-book"></i></div>
          <h3 class="card-title">Total Courses</h3>
        </div>
        <div class="card-value" id="total-courses">Loading...</div>
      </div>

      <!-- Job Postings Card -->
      <div class="card card-5">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-briefcase"></i></div>
          <h3 class="card-title">Job Postings</h3>
        </div>
        <div class="card-value" id="job-postings">Loading...</div>
      </div>

      <!-- Faculty Programs Card -->
      <div class="card card-6">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-chalkboard"></i></div>
          <h3 class="card-title">Faculty Programs</h3>
        </div>
        <div class="card-value" id="faculty-programs">Loading...</div>
      </div>

      <!-- Faculty Recruitment Card -->
      <div class="card card-7">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-user-tie"></i></div>
          <h3 class="card-title">Faculty Recruitment</h3>
        </div>
        <div class="card-value" id="faculty-recruitment">Loading...</div>
      </div>

      <!-- University Fundings Card -->
      <div class="card card-8">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-money-check-alt"></i></div>
          <h3 class="card-title">University Fundings</h3>
        </div>
        <div class="card-value" id="university-fundings">Loading...</div>
      </div>
    </div>
  </main>
  
  <!-- Link to external JavaScript -->
  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>