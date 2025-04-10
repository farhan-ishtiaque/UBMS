@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Student</h2>

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

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        @include('partials.student_form_fields')

        <button type="submit" class="btn btn-success">Create Student</button>
    </form>
</div>
@endsection
