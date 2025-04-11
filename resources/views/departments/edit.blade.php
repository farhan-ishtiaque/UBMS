@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Department</h2>

        <!-- University Selection Dropdown -->
        <form method="GET" action="{{ route('departments.index') }}">
            <div class="mb-3">
                <select name="uni_id" id="university" class="form-select" onchange="this.form.submit()">
                    <option value="">Select University</option>
                    @foreach($universities as $university)
                        <option value="{{ $university->uni_id }}" {{ request('uni_id') == $university->uni_id ? 'selected' : '' }}>
                            {{ $university->uni_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Department Edit Form -->
        <form method="POST" action="{{ route('departments.update', $department->dept_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="dept_name" class="form-label">Department Name</label>
                <input type="text" class="form-control" name="dept_name" id="dept_name" value="{{ old('dept_name', $department->dept_name) }}">
            </div>

            <div class="mb-3">
                <label for="email_address" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email_address" id="email_address" value="{{ old('email_address', $department->email_address) }}">
            </div>

            <div class="mb-3">
                <label for="programs" class="form-label">Program Type</label>
                <select name="programs" id="programs" class="form-select">
                    <option value="Undergraduate" {{ $department->programs == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                    <option value="Postgraduate" {{ $department->programs == 'Postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number', $department->phone_number) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Department</button>
        </form>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
