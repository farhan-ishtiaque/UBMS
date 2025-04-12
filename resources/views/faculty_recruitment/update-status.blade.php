<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your existing head content remains the same -->
</head>
<body>
    <div class="container">
        <h1>Update Recruitment Status</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('update-status') }}">
            <label for="university">Select University:</label>
            <select name="university_id" id="university" onchange="this.form.submit()">
                <option value="">-- Choose University --</option>
                @foreach ($universities as $uni)
                    <option value="{{ $uni->uni_id }}" {{ request('university_id') == $uni->uni_id ? 'selected' : '' }}>
                        {{ $uni->uni_name }}
                    </option>
                @endforeach
            </select>
        </form>

        @if(isset($jobPostings) && $jobPostings->count() > 0)
        <form method="POST" action="{{ route('update-status.save') }}">
            @csrf
            <input type="hidden" name="university_id" value="{{ request('university_id') }}">

            <table>
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Department</th>
                        <th>Current Status</th>
                        <th>Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobPostings as $job)
                        <tr>
                            <td>{{ $job->job_title }}</td>
                            <td>{{ $job->department->dept_name ?? 'N/A' }}</td>
                            <td>{{ ucfirst($job->facultyRecruitments->first()->recruitment_status ?? 'Not Set') }}</td>
                            <td>
                                <select name="statuses[{{ $job->job_id }}]" class="status-select">
                                    <option value="waiting" {{ ($job->facultyRecruitments->first()->recruitment_status ?? null) == 'waiting' ? 'selected' : '' }}>
                                        Waiting
                                    </option>
                                    <option value="approved" {{ ($job->facultyRecruitments->first()->recruitment_status ?? null) == 'approved' ? 'selected' : '' }}>
                                        Approved
                                    </option>
                                    <option value="declined" {{ ($job->facultyRecruitments->first()->recruitment_status ?? null) == 'declined' ? 'selected' : '' }}>
                                        Declined
                                    </option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn-submit">Update Statuses</button>
        </form>
        @elseif(request('university_id'))
            <p>No job postings found for this university.</p>
        @endif
    </div>
</body>
</html>