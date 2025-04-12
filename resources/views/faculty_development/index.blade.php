@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('mod_facultydevelopment_menu') }}" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
        </a>
        <h2>All Faculty Development Programs</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>

                    <th>Program Name</th>
                    <th>Type</th>
                    <th>Department</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programs as $program)
                    <tr>
                        <td>{{ $program->development_id }}</td>
                        <td>{{ $program->program_name }}</td>
                        <td>{{ ucfirst($program->program_type) }}</td>
                        <td>{{ $program->department->dept_name ?? 'N/A' }}</td>
                        <td>{{ $program->start_date }}</td>
                        <td>{{ $program->end_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No development programs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection