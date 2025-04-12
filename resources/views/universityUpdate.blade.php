@extends('layouts.app')

@section('title', 'Update University Accreditation')

@section('content')
<div class="container">
    <h2>Update University Accreditation</h2>

    {{-- Success Message --}}
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{-- Form to Select a University (GET) --}}
    <form method="GET" action="{{ route('universities.update') }}">
        <div class="form-group">
            <label for="university">Choose a University:</label>
            <select name="universityId" id="university" class="form-control" onchange="this.form.submit()">
                <option value="">Select University</option>
                @foreach($universities as $universityOption)
                    <option value="{{ $universityOption->uni_id }}" 
                        {{ request('universityId') == $universityOption->uni_id ? 'selected' : '' }}>
                        {{ $universityOption->uni_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
    @if($university)
    <form method="POST" action="{{ route('universities.update.accreditation', ['id' => $university->uni_id]) }}">
        @csrf

        <div class="form-group">
            <label for="accreditation_status">Accreditation Status</label>
            <select name="accreditation_status" id="accreditation_status" class="form-control">
                <option value="Accredited">Accredited</option>
                <option value="Not Accredited">Not Accredited</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Accreditation</button>
    </form>
@endif
