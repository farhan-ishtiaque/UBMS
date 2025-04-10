<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UMSB Dashboard</title>
  <!-- Link to external CSS and Font Awesome icons -->
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo-container">
      <i class="fas fa-university logo-icon"></i>
      <span class="logo-text">UMSB</span>
    </div>
    <ul class="menu">
      <li class="menu-item"><a href="{{route('universities.accredited')}}" class="menu-link"><i class="fas fa-university"></i>Universities</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-user-graduate"></i> Students</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-chalkboard-teacher"></i> Faculties</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-briefcase"></i> Job Postings</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-trophy"></i> Rankings</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-chalkboard"></i> Faculty Development</a></li>
      <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-money-check-alt"></i> University Fundings</a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <div class="header">
      <h1 class="page-title">Dashboard Overview</h1>
      <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="logout-button">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>
    </div>

    <div class="card-grid">
      <!-- University Cards -->
      <div class="card card-1">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-university"></i></div>
          <h3 class="card-title">Total Universities</h3>
        </div>
        <div class="card-value" id="total-universities">Loading...</div>
      </div>

      <div class="card card-2">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-building"></i></div>
          <h3 class="card-title">Public Universities</h3>
        </div>
        <div class="card-value" id="public-universities">Loading...</div>
      </div>

      <div class="card card-3">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-landmark"></i></div>
          <h3 class="card-title">Private Universities</h3>
        </div>
        <div class="card-value" id="private-universities">Loading...</div>
      </div>

      <!-- Faculty Cards -->
      <div class="card card-4">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
          <h3 class="card-title">Total Faculties</h3>
        </div>
        <div class="card-value" id="total-faculties">Loading...</div>
      </div>

      <div class="card card-5">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-user-tie"></i></div>
          <h3 class="card-title">Public Faculties</h3>
        </div>
        <div class="card-value" id="public-faculties">Loading...</div>
      </div>

      <div class="card card-6">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-user-graduate"></i></div>
          <h3 class="card-title">Private Faculties</h3>
        </div>
        <div class="card-value" id="private-faculties">Loading...</div>
      </div>

      <!-- Student Cards -->
      <div class="card card-7">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-users"></i></div>
          <h3 class="card-title">Total Students</h3>
        </div>
        <div class="card-value" id="total-students">Loading...</div>
      </div>

      <div class="card card-8">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-school"></i></div>
          <h3 class="card-title">Public Students</h3>
        </div>
        <div class="card-value" id="public-students">Loading...</div>
      </div>

      <div class="card card-1">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-graduation-cap"></i></div>
          <h3 class="card-title">Private Students</h3>
        </div>
        <div class="card-value" id="private-students">Loading...</div>
      </div>

      <!-- Other Cards -->
      <div class="card card-2">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-briefcase"></i></div>
          <h3 class="card-title">Job Postings</h3>
        </div>
        <div class="card-value" id="job-postings">Loading...</div>
      </div>

      <div class="card card-3">
        <div class="card-header">
          <div class="card-icon"><i class="fas fa-chalkboard"></i></div>
          <h3 class="card-title">Faculty Programs</h3>
        </div>
        <div class="card-value" id="faculty-programs">Loading...</div>
      </div>
    </div>
  </main>
  
  <!-- Link to external JavaScript (reusing the same JS file) -->
  <script src="{{ asset('js/ubms_dashboard.js') }}"></script>
</body>
</html>