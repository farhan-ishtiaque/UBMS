<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Transcript Viewer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mod_transcript.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <a href="{{ route('mod_students_menu')}}" class="back-button">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>
                <h2>Delete Students</h2>
                
                <div class="row mb-4">
                    <div class="col-md-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by name or email...">
                    </div>
                    <div class="col-md-3">
                        <select id="universityFilter" class="form-control">
                            <option value="">All Universities</option>
                            @foreach($universities as $university)
                                <option value="{{ $university->uni_id }}">{{ $university->uni_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="departmentFilter" class="form-control">
                            <option value="">All Departments</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button id="searchBtn" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>University</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="resultsBody">
                            <tr>
                                <td colspan="7" class="text-center">Use the search above to find students</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div id="paginationInfo" class="pagination-info"></div>
                    <div id="paginationControls" class="btn-group"></div>
                </div>
            </div>
        </div>
        
        <!-- Transcript Modal -->
        <div class="modal fade" id="transcriptModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Student Transcript</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="transcriptContent">
                        <!-- Transcript content will be loaded here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="printTranscriptBtn">Print Transcript</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Deletion</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this student record? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/mod_transcript.js') }}"></script>
</body>
</html>