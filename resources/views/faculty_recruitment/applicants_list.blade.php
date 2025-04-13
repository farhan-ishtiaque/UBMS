<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Applicants for {{ $jobPosting->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/status.css') }}">
</head>
<body>
    <h2>Applicants </h2>

    <ul>
        @foreach ($applicants as $applicant)
            <li>
                {{ $applicant->first_name }} {{ $applicant->last_name }} - {{ $applicant->email }}<br>
                Status: {{ $applicant->recruitment_status }}<br>

                <form method="POST" action="{{ route('applicant.updateStatus', $applicant->recruitment_id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="status" value="Approved">Approve</button>

                    <button type="submit" name="status" value="Declined">Decline</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>