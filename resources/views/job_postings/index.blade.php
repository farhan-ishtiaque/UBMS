<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <a href="{{ route('mod_jobposting_menu')}}" class="back-button">
        <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
    </a>

    <title>All Job Postings</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: var(--border-radius);
            background-color: rgba(67, 97, 238, 0.1);
            transition: var(--transition);
            text-decoration: none;
            font-weight: 500;
        }

        .back-button:hover {
            background-color: rgba(67, 97, 238, 0.2);
            text-decoration: none;
            color: var(--secondary-color);
            transform: translateY(-1px);
        }


        h1 {
            text-align: center;
            font-size: 32px;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .job-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            overflow: hidden;
        }

        .job-table th,
        .job-table td {
            padding: 16px 20px;
            text-align: left;
        }

        .job-table thead {
            background-color: #2e5aac;
            color: #fff;
        }

        .job-table tbody tr:nth-child(even) {
            background-color: #f4f6fb;
        }

        .job-table tbody tr:hover {
            background-color: #e9efff;
        }

        .no-data {
            text-align: center;
            color: #777;
            font-size: 18px;
            padding: 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .apply-button {
            padding: 8px 16px;
            background-color: #2e5aac;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .apply-button:hover {
            background-color: #1d4589;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>All Job Postings</h1>

        @if ($jobPostings->isEmpty())
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
                                <a href="{{ route('faculty-recruitment.create', $job->job_id) }}" class="apply-button">
                                    Apply
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