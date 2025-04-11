@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div class="container">
    <h2>Departments List</h2>

    <!-- University Dropdown -->
    <form method="GET" action="{{ route('departments.index') }}">
        <div class="mb-3">
            <select name="uni_id" id="university" class="form-select" onchange="this.form.submit()">
                <option value="">-- Select a University --</option>
                @foreach($universities as $university)
                    <option value="{{ $university->uni_id }}" {{ request('uni_id') == $university->uni_id ? 'selected' : '' }}>
                        {{ $university->uni_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Departments Table -->
    @if(!empty($departments) && count($departments) > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h4>Departments of {{ $departments[0]->university->uni_name }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Department Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Program Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $department->dept_name }}</td>
                                <td>{{ $department->email_address }}</td>
                                <td>{{ $department->phone_number }}</td>
                                <td>{{ $department->programs }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif($uni_id)
        <p class="mt-4">No departments found for the selected university.</p>
    @endif
</div>
@endsection
