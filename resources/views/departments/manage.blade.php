@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Departments</h2>

        <!-- University Dropdown -->
        <form method="GET" action="{{ route('departments.manage') }}">
            <div class="mb-3">

                <a href="{{ route('mod_departments_menu') }}" class="btn btn-outline-secondary mb-4">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>


                <select class="form-select" name="uni_id" id="uni_id" onchange="this.form.submit()">
                    <option disabled selected>Select a university</option>
                    @foreach ($universities as $university)
                        <option value="{{ $university->uni_id }}" {{ request('uni_id') == $university->uni_id ? 'selected' : '' }}>
                            {{ $university->uni_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if($departments->count() > 0)
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>Department Name</th>
                        <th>Email</th>
                        <th>Program</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->dept_name }}</td>
                            <td>{{ $department->email_address }}</td>
                            <td>{{ $department->programs }}</td>
                            <td>{{ $department->phone_number }}</td>
                            <td>
                                <a href="{{ route('departments.edit', $department->dept_id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(request('uni_id'))
            <p class="mt-4">No departments found for this university.</p>
        @endif
    </div>
@endsection