<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants for Job {{ $jobId }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .no-data {
            text-align: center;
            color: #777;
        }
        select {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
        }
        form {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Applicants for Job Posting #{{ $jobId }}</h1>

        @if ($applicants->isEmpty())
            <div class="no-data">No applicants yet.</div>
        @else
            <table class="applicants-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Qualification</th>
                        <th>Experience</th>
                        <th>Recruitment Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applicants as $applicant)
                        <tr>
                            <td>{{ $applicant->first_name }} {{ $applicant->middle_name }} {{ $applicant->last_name }}</td>
                            <td>{{ $applicant->email }}</td>
                            <td>{{ $applicant->qualification }}</td>
                            <td>{{ $applicant->experience }}</td>
                            <td>{{ $applicant->recruitment_status }}</td>
                            <td>
                                <!-- Add button to update recruitment status -->
                                <form method="POST" action="{{ route('faculty-recruitment.updateStatus', $applicant->recruitment_id) }}">
                                    @csrf
                                    @method('PUT')
                                    <select name="recruitment_status" onchange="this.form.submit()">
                                        <option value="Approved" {{ $applicant->recruitment_status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Declined" {{ $applicant->recruitment_status == 'Declined' ? 'selected' : '' }}>Declined</option>
                                        <option value="Waiting" {{ $applicant->recruitment_status == 'Waiting' ? 'selected' : '' }}>Waiting</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
