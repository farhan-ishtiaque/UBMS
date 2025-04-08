<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accredited Universities</title>
</head>
<body>
    <h1>List of Accredited Universities</h1>

    @if($universities->isEmpty())
        <p>No accredited universities found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>University Name</th>
                    <th>Location</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($universities as $university)
                    <tr>
                        <td>{{ $university->uni_name }}</td>
                        <td>{{ $university->district }}</td>
                        <td>{{ $university->email_address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>