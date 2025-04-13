<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Registration Form - UBMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/uniRegistration.css') }}">
</head>
<body>
    <div class="container mt-5">
        <a href="{{ route('mod_uni_menu')}}" class="back-button">
            <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
        </a>

        <h1 class="text-center mb-4">University Registration Form</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('university.registration.post') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
            @csrf

            <!-- Section 1: University Information -->
            <h3 class="mt-4">Section 1: University Information</h3>
            @foreach ([ 
                'universityName' => 'University Name', 
                'uniType' => 'University Type', 
                'portalCode' => 'Portal Code', 
                'establishedYear' => 'Established Year', 
                'studentTeacherRatio' => 'Student-Teacher Ratio' 
            ] as $field => $label)
                <div class="form-group">
                    <label for="{{ $field }}">{{ $label }}</label>
                    @if ($field == 'uniType')
                        <select name="uniType" id="uniType" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            <option value="Public" {{ old('uniType') == 'Public' ? 'selected' : '' }}>Public</option>
                            <option value="Private" {{ old('uniType') == 'Private' ? 'selected' : '' }}>Private</option>
                        </select>
                    @elseif ($field == 'portalCode')
                        <input type="text" name="portalCode" id="portalCode" class="form-control" value="{{ old('portalCode') }}" required>
                    @else
                        <input type="{{ $field == 'establishedYear' ? 'number' : 'text' }}"
                               class="form-control" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}" required>
                    @endif
                </div>
            @endforeach

            <!-- New Fields: District and Area -->
            <div class="form-group">
                <label for="district">District</label>
                <input type="text" class="form-control" id="district" name="district" value="{{ old('district') }}" required>
            </div>

            <div class="form-group">
                <label for="area">Area</label>
                <input type="text" class="form-control" id="area" name="area" value="{{ old('area') }}" required>
            </div>

            <!-- Section 2: Required Documentation -->
            <h3 class="mt-4">Section 2: Required Documentation</h3>
            <p>Please upload the following documents in PDF format (optional):</p>
            @foreach([ 
                'courseSyllabi' => '1. Updated Course Syllabi (PDF)', 
                'facultyProof' => '2. Proof of ≥60% Full-Time Faculty (PDF)', 
                'revenueDeposit' => '3. Evidence of 5% Revenue Deposit (PDF)' 
            ] as $name => $label)
                <div class="form-group">
                    <label for="{{ $name }}">{{ $label }}</label>
                    <input type="file" class="form-control" id="{{ $name }}" name="{{ $name }}" accept=".pdf">
                </div>
            @endforeach

            <div class="form-group">
                <label for="researchPapers">4. Proof of Minimum 5 Published Research Papers (PDF)</label>
                <input type="file" class="form-control" id="researchPapers" name="researchPapers[]" accept=".pdf" multiple>
                <small class="form-text text-muted">Upload all relevant papers in PDF format.</small>
            </div>

            <!-- Section 3: Declaration -->
            <h3 class="mt-4">Section 3: Declaration</h3>
            <p>I certify that all provided information is accurate and complete.</p>
            <p>I understand that falsified documents may result in registration revocation.</p>

            @foreach([ 
                'signatoryName' => 'Authorized Signatory Name', 
                'designation' => 'Designation', 
                'signature' => 'Signature', 
                'submissionDate' => 'Date' 
            ] as $field => $label)
                <div class="form-group">
                    <label for="{{ $field }}">{{ $label }}</label>
                    <input type="{{ $field === 'submissionDate' ? 'date' : 'text' }}" class="form-control" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}" required>
                </div>
            @endforeach

            <!-- Accept Conditions Checkbox -->
            <div class="form-group">
                <label for="acceptConditions">
                    <input type="checkbox" name="acceptConditions" id="acceptConditions" {{ old('acceptConditions') ? 'checked' : '' }} required>
                    I accept the terms and conditions
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Submit Registration</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
