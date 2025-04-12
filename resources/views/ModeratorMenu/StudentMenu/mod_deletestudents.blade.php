<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Transcript Viewer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/mod_transcript.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2>Student Transcript Viewer</h2>
                
                <div class="row mb-4">
                    <div class="col-md-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by name or email...">
                    </div>
                    <div class="col-md-3">
                        <select id="universityFilter" class="form-control">
                            <option value="">All Universities</option>
                            <!-- Universities will be loaded dynamically -->
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
                    <div id="paginationInfo" class="text-muted"></div>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="transcriptContent">
                        <!-- Transcript content will be loaded here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="printTranscriptBtn">Print Transcript</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/mod_transcript.js"></script>
</body>
</html>