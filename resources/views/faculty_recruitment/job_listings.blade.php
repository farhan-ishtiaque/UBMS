<!DOCTYPE html>
<html>
<head>
    <title>Job Listings</title>
    <link rel="stylesheet" href="{{ asset('css/status.css') }}">
</head>
<body>
    <h1>Faculty Job Postings</h1>
    
    <div class="search-box">
        <form method="GET" action="{{ route('job-listings.index') }}">
            <input type="text" name="uni_name" 
                   placeholder="Search by university name" 
                   value="{{ request('uni_name') }}">
            <button type="submit">Search</button>
        </form>
    </div>

    @if($jobPostings->isEmpty())
        <p>No job postings found.</p>
    @else
        @foreach($jobPostings as $job) 
            <div class="job-listing">
                <h3>{{ $job->title }}</h3>
                <p>University: {{ $job->university->name }}</p>
                <a href="{{ route('applicants.index', $job->job_id) }}" 
                   class="btn btn-view">View Applicants</a>
            </div>
        @endforeach
    @endif
</body>
</html>