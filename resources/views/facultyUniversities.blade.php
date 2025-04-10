{{-- resources/views/universities/index.blade.php --}}

@extends('layouts.app')
@section('title', 'Faculty Universities')
@section('content')
    <div class="container">
        <h2>Select University</h2>
        
        <form method="GET" action="{{ route('universities.list') }}">
            <label for="university">Choose a University:</label>
            <select name="university" id="university">
                <option value="">Select University</option>
                @foreach($universities as $university)
                    <option value="{{ $university->uni_id }}">{{ $university->uni_name }}</option>
                @endforeach
            </select>
            <button type="submit">View Faculties</button>
        </form>

        @isset($selectedUniversity)
            <h3>Faculty List for {{ $selectedUniversity->uni_name }}</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th>Faculty Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($selectedUniversity->faculties as $faculty)
                        <tr>
                            <td>{{ $faculty->first_name }} {{ $faculty->last_name }}</td>
                            <td><a href="{{ route('faculties.edit', $faculty->faculty_id) }}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset
    </div>
@endsection
