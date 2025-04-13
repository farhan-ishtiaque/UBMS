<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Listings</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Styles remain the same */
    </style>
</head>
<body>
    <div class="container">
        <h1>Job Postings</h1>
        
        <div class="search-box">
            <form method="GET" action="{{ route('job-listings.index2') }}">
                <input type="text" name="uni_name" 
                       placeholder="Search by university name" 
                       value="{{ request('uni_name') }}">
                <button type="submit">Search</button>
            </form>
        </div>

        @if($jobPostings->isEmpty())
            <div class="no-data">No job postings found.</div>
        @else
            <table class="job-table">
                <thead>
                    <tr>
                        <th>University</th>
                        <th>Department</th>
                        <th>Job Title</th>
                        <th>Job Type</th>
                        <th>Start Date</th>
                        <th>Deadline</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobPostings as $job)
                        <tr>
                            <td>{{ $job->university->uni_name ?? 'N/A' }}</td>
                            <td>{{ $job->department->dept_name ?? 'N/A' }}</td>
                            <td>{{ $job->job_title }}</td>
                            <td>{{ $job->job_type }}</td>
                            <td>{{ \Carbon\Carbon::parse($job->application_start_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($job->application_deadline)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('job-listings.applicants', $job->job_id) }}" class="apply-button">
                                    View Applicants
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        @endif
    </div>
</body>
</html>
