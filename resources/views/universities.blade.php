<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accredited Universities</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/university.css') }}">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <a href="{{ route('mod_uni_menu')}}" class="back-button">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>

                <h1 class="h3 mb-0 text-center">List of Accredited Universities</h1>
            </div>

            <div class="card-body">
                @if($accreditedUniversities->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        No accredited universities found.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>University Name</th>
                                    <th>Location</th>
                                    <th>Type</th>
                                    <th>Established</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accreditedUniversities as $university)
                                    <tr>
                                        <td>
                                            <strong>{{ $university->uni_name }}</strong>
                                            <div class="small text-muted">{{ $university->area }}, {{ $university->district }}
                                            </div>
                                        </td>
                                        <td>{{ $university->district }}</td>
                                        <td>
                                            <span class="badge bg-{{ $university->uni_type == 'Public' ? 'info' : 'warning' }}">
                                                {{ $university->uni_type }}
                                            </span>
                                        </td>
                                        <td>{{ $university->established_year }}</td>
                                        <td>
                                            <div><a
                                                    href="mailto:{{ $university->email_address }}">{{ $university->email_address }}</a>
                                            </div>
                                            <div>{{ $university->phone_number }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>