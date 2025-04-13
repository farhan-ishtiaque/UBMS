{{-- resources/views/universities/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Faculty Universities')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .university-card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: none;
            margin-bottom: 30px;
        }
        .card-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 20px;
        }
        .select2-container--default .select2-selection--single {
            height: 45px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 45px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 45px;
        }
        .action-btn {
            transition: all 0.3s ease;
            padding: 8px 15px;
            border-radius: 6px;
        }
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .faculty-table {
            border-radius: 8px;
            overflow: hidden;
        }
        .faculty-table thead {
            background: #f8f9fa;
        }
        .back-btn {
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            transform: translateX(-3px);
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <a href="{{ route('mod_faculties_menu') }}" class="btn btn-light back-btn">
            <i class="fas fa-arrow-left me-2"></i> Back to Faculty Menu
        </a>

        <div class="card university-card">
            <div class="card-header">
                <h3 class="mb-0">Select University</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('universities.list') }}" class="mb-4">
                    <div class="row align-items-end">
                        <div class="col-md-8">
                            <label for="university" class="form-label">Choose a University</label>
                            <select name="university" id="university" class="form-select select2">
                                <option value="">Select University</option>
                                @foreach($universities as $university)
                                    <option value="{{ $university->uni_id }}" {{ request('university') == $university->uni_id ? 'selected' : '' }}>
                                        {{ $university->uni_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i> View Faculties
                            </button>
                        </div>
                    </div>
                </form>

                @isset($selectedUniversity)
                    <div class="mt-4">
                        <h4 class="mb-3">Faculty List for <span class="text-primary">{{ $selectedUniversity->uni_name }}</span></h4>

                        <div class="table-responsive">
                            <table class="table faculty-table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Faculty Name</th>
                                        <th>Designation</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($selectedUniversity->faculties as $faculty)
                                        <tr>
                                            <td>{{ $faculty->first_name }} {{ $faculty->last_name }}</td>
                                            <td>{{ $faculty->designation }}</td>
                                            <td>{{ $faculty->email }}</td>
                                            <td>
                                                <a href="{{ route('faculties.edit', $faculty->faculty_id) }}" 
                                                   class="btn btn-sm btn-outline-primary action-btn">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select a university",
                allowClear: true
            });
        });
    </script>
@endpush