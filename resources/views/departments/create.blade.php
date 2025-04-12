@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('mod_departments_menu') }}" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
        </a>
        <h2>Create Department</h2>

        <!-- University Selection Dropdown -->
        <form method="POST" action="{{ route('departments.store') }}">
            @csrf

            <div class="mb-3">
                <select name="uni_id" id="university" class="form-select">
                    <option value="">Select University</option>
                    @foreach($universities as $university)
                        <option value="{{ $university->uni_id }}">{{ $university->uni_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="dept_name" class="form-label">Department Name</label>
                <input type="text" class="form-control" name="dept_name" id="dept_name" required>
            </div>

            <div class="mb-3">
                <label for="email_address" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email_address" id="email_address">
            </div>

            <div class="mb-3">
                <label for="programs" class="form-label">Program Type</label>
                <select name="programs" id="programs" class="form-select">
                    <option value="Undergraduate">Undergraduate</option>
                    <option value="Postgraduate">Postgraduate</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number">
            </div>

            <button type="submit" class="btn btn-primary">Create Department</button>
        </form>
    </div>
@endsection