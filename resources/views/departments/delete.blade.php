@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('mod_departments_menu') }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
    </a>
    <h2>Delete Department</h2>

    <!-- Show success message -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- University Dropdown -->
    <form method="GET" action="{{ route('departments.deletePage') }}">
        <div class="mb-3"> <select class="form-select" name="uni_id" id="uni_id" onchange="this.form.submit()">
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
        <table class="table table-bordered mt-4">
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
                            <form action="{{ route('departments.destroy', $department->dept_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
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
