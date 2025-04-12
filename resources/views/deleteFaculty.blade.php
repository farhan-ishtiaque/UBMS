@extends('layouts.app')

@section('title', 'Delete Faculty')

@push('styles')
    <link href="{{ asset('css/faculties-delete.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <h2>Delete Faculty</h2>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="GET" action="{{ route('faculties.delete.page') }}">
            <label for="university">Choose a University:</label>
            <select name="university" id="university" class="form-control" onchange="this.form.submit()">
                <option value="">Select University</option>
                @foreach($universities as $university)
                    <option value="{{ $university->uni_id }}" {{ request('university') == $university->uni_id ? 'selected' : '' }}>
                        {{ $university->uni_name }}
                    </option>
                @endforeach
            </select>
        </form>

        @isset($selectedUniversity)
            <h3 class="mt-4">Faculties of {{ $selectedUniversity->uni_name }}</h3>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Faculty Name</th>
                        <th>Designation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($selectedUniversity->faculties as $faculty)
                        <tr>
                            <td>{{ $faculty->first_name }} {{ $faculty->last_name }}</td>
                            <td>{{ $faculty->designation }}</td>
                            <td>
                                <form action="{{ route('faculties.delete', $faculty->faculty_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this faculty?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset
    </div>
@endsection