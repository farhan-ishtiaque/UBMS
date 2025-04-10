@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Student</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->student_id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('partials.student_form_fields', ['student' => $student])

        <button type="submit" class="btn btn-primary">Update Student</button>
    </form>
</div>
@endsection
