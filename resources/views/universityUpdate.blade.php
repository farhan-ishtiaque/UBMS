@extends('layouts.app')

@section('title', 'Update University Accreditation')

@section('content')
    <div class="container">

        <a href="{{ route('mod_uni_menu') }}" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
        </a>


        <h2>Update University Accreditation</h2>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="GET" action="{{ route('universities.update') }}" class="mb-4">
            <div class="form-group">
                <label for="university">Choose a University:</label>
                <select name="universityId" id="university" class="form-control" onchange="this.form.submit()">
                    <option value="">Select University</option>
                    @foreach($universities as $universityOption)
                        <option value="{{ $universityOption->uni_id }}" {{ request('universityId') == $universityOption->uni_id ? 'selected' : '' }}>
                            {{ $universityOption->uni_name }} ({{ $universityOption->accreditation_status }})
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if(isset($university))
            <form method="POST" action="{{ route('universities.update.accreditation', $university) }}">
                @csrf

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Update Accreditation for {{ $university->uni_name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="accreditation_status">Accreditation Status</label>
                            <select name="accreditation_status" id="accreditation_status" class="form-control">
                                <option value="Accredited" {{ $university->accreditation_status === 'Accredited' ? 'selected' : '' }}>
                                    Accredited
                                </option>
                                <option value="Not Accredited" {{ $university->accreditation_status === 'Not Accredited' ? 'selected' : '' }}>
                                    Not Accredited
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Accreditation</button>
            </form>
        @endif
    </div>
@endsection