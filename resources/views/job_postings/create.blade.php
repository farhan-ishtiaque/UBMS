<!DOCTYPE html>
<html>
<head>
    <title>Create Job Posting</title>
    <link rel="stylesheet" href="{{ asset('css/job.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
<section class="job-posting-section">
  <div class="form-container">
    <div class="form-wrapper">
      <h1 class="form-title">Create Job Posting</h1>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif

      <div class="form-card">
        <div class="card-body">
          <form method="POST" action="{{ route('job-postings.store') }}">
            @csrf

            <!-- University Dropdown -->
            <div class="form-row">
              <div class="form-label-col">
                <label class="form-label">University</label>
              </div>
              <div class="form-input-col">
                <select name="uni_id" class="form-control" required>
                  <option value="">Select University</option>
                  @foreach($universities as $university)
                    <option value="{{ $university->uni_id }}">{{ $university->uni_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-divider"></div>

            <!-- Department (Text Input) -->
            <div class="form-row">
              <div class="form-label-col">
                <label class="form-label">Department Name</label>
              </div>
              <div class="form-input-col">
                <input type="text" class="form-control" name="dept_name" placeholder="Enter department name" required />
              </div>
            </div>
            <div class="form-divider"></div>

            <!-- Job Title -->
            <div class="form-row">
              <div class="form-label-col">
                <label class="form-label">Job Title</label>
              </div>
              <div class="form-input-col">
                <input type="text" class="form-control" name="job_title" placeholder="e.g., Senior Software Engineer" required />
              </div>
            </div>
            <div class="form-divider"></div>

            <!-- Job Type -->
            <div class="form-row">
              <div class="form-label-col">
                <label class="form-label">Job Type</label>
              </div>
              <div class="form-input-col">
                <input type="text" class="form-control" name="job_type" placeholder="e.g., Full-time, Part-time" required />
              </div>
            </div>
            <div class="form-divider"></div>

            <!-- Job Requirements -->
            <div class="form-row">
              <div class="form-label-col">
                <label class="form-label">Job Requirements</label>
              </div>
              <div class="form-input-col">
                <textarea class="form-control" name="requirements" rows="4" required placeholder="List the key requirements..."></textarea>
              </div>
            </div>
            <div class="form-divider"></div>

            <!-- Date Fields -->
            <div class="form-row">
              <div class="form-label-col">
                <label class="form-label">Application Period</label>
              </div>
              <div class="form-input-col date-fields">
                <div class="date-field">
                  <label class="date-label">Start Date</label>
                  <input type="date" class="form-control" name="application_start_date" required />
                </div>
                <div class="date-field">
                  <label class="date-label">Deadline</label>
                  <input type="date" class="form-control" name="application_deadline" required />
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="form-actions">
              <button type="submit" class="submit-btn">Post Job</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
