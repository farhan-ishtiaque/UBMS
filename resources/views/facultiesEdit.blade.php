{{-- resources/views/faculties/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Faculty Information</h2>

        <form method="POST" action="{{ route('faculties.update', $faculty->faculty_id) }}">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" value="{{ $faculty->first_name }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{ $faculty->last_name }}" required>
            </div>

            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" class="form-control" name="designation" value="{{ $faculty->designation }}" required>
            </div>

            <div class="form-group">
                <label for="qualification">Qualification</label>
                <input type="text" class="form-control" name="qualification" value="{{ $faculty->qualification }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        @if(session('status'))
            <div class="alert alert-success mt-3">{{ session('status') }}</div>
        @endif
    </div>
@endsection
