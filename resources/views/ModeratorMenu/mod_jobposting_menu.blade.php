<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Moderator Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/menu_list.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <main class="main-container">

    <!-- Top Branding -->
    <div class="branding">
      <img src="{{ asset('images/UBMS logo1.png') }}" alt="UBMS Logo" class="logo">
      <div class="branding-text">
        <h1 class="ubms-title">UBMS</h1>
        <p class="ubms-subtitle">University of Bangladesh Management System</p>
      </div>
    </div>

    <!-- Page Header -->
    <div class="header">
      <h2 class="page-title">Job Postings Management</h2>
      <a href="{{ route('moderator.dashboard') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Back
      </a>
    </div>

    <!-- Card Section -->
    <div class="card-grid">
      <a href="{{route('job-postings.index')}}" class="card card-1">
        <div class="card-icon"><i class="fas fa-eye"></i></div>
        <h3 class="card-title">View Job Postings</h3>
      </a>

      <a href="{{route('job_postings.create')}}" class="card card-2">
        <div class="card-icon"><i class="fas fa-plus-circle"></i></div>
        <h3 class="card-title">Register Job Posting</h3>
      </a>
      
    </div>
  </main>
</body>
</html>
