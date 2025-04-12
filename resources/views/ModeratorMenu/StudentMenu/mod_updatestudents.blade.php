<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student Information</title>
    <link rel="stylesheet" href="{{ asset('css/mod_updatestudents.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="back-btn-container">
            <a href="{{ route('mod_students_menu') }}" class="back-btn">← Back</a>
        </div>

        <h2>Update Student Information</h2>

        <div class="search-section">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search by name or email...">
                <button id="searchBtn"><i class="fas fa-search"></i> Search</button>
            </div>
            
            <div class="results-container">
                <div class="results-header">
                    <h3>Search Results</h3>
                    <div class="pagination-info" id="paginationInfo"></div>
                </div>
                <div class="results-table-container">
                    <table class="results-table">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>University</th>
                                <th>Department</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="resultsBody">
                            <!-- Results will be populated here -->
                        </tbody>
                    </table>
                </div>
                <div class="pagination-controls" id="paginationControls"></div>
            </div>
        </div>

        <div class="update-form-section" id="updateFormSection" style="display: none;">
            <h3>Update Student Information</h3>
            <form id="updateStudentForm">
                <input type="hidden" id="student_id" name="student_id">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="uni_id">University</label>
                        <select id="uni_id" name="uni_id" required>
                            <option value="">Select a University</option>
                            @foreach($universities as $university)
                                <option value="{{ $university->uni_id }}">{{ $university->uni_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dept_id">Department</label>
                        <select id="dept_id" name="dept_id" required>
                            <option value="">Select a Department</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input id="first_name" name="first_name" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" name="last_name" type="text" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input id="phone_number" name="phone_number" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input id="address" name="address" type="text">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input id="date_of_birth" name="date_of_birth" type="date" required class="form-control">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="cgpa">CGPA</label>
                        <input id="cgpa" name="cgpa" type="number" step="0.01" min="0" max="4">
                    </div>

                    <div class="form-group">
                        <label for="graduation_status">Graduation Status</label>
                        <select id="graduation_status" name="graduation_status" required>
                            <option value="not_graduated">Not Graduated</option>
                            <option value="graduated">Graduated</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn update-btn">Update Student</button>
                    <button type="button" class="btn cancel-btn" id="cancelUpdate">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/mod_studentupdate.js') }}"></script>
</body>
</html>