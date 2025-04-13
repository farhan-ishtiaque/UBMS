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
      <h2 class="page-title">Student Management</h2>
      <a href="{{ route('uniAdmin.dashboard') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Back
      </a>
    </div>

    <!-- Card Section -->
    <div class="card-grid">
      <a href="{{route('admin_view_students')}}" class="card card-1">
        <div class="card-icon"><i class="fas fa-eye"></i></div>
        <h3 class="card-title">View Students</h3>
      </a>

      <a href="{{route('admin_add_students')}}" class="card card-2">
        <div class="card-icon"><i class="fas fa-plus-circle"></i></div>
        <h3 class="card-title">Register Student</h3>
      </a>

      <a href="{{route('admin_update_students')}}" class="card card-3">
        <div class="card-icon"><i class="fas fa-edit"></i></div>
        <h3 class="card-title">Update Student</h3>
      </a>

      <a href="{{route('admin_delete_students')}}" class="card card-4">
        <div class="card-icon"><i class="fas fa-times"></i></div>
        <h3 class="card-title">Delete Student</h3>
      </a>

      a href="{{route('admin_students_transcript')}}" class="card card-4">
        <div class="card-icon"><i class="fas fa-file-alt"></i></div>
        <h3 class="card-title">Student Transcript</h3>
      </a>

      <a href="{{route('admin_update_scholarships')}}" class="card card-4">
        <div class="card-icon"><i class="fas fa-pen-to-square"></i></div>
        <h3 class="card-title">Update Scholarship</h3>
      </a>

    </div>
  </main>
</body>
</html>
