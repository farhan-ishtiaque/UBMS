<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - UMSB</title>
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Base Styles */
        html, body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
            color: #212529;
        }
        
        main {
            flex: 1;
        }
        
        /* Card Styling */
        .card {
            border-radius: 25px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        /* Search Container */
        .search-container {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 200px;
            overflow-y: auto;
            background: white;
            border: 1px solid #ddd;
            border-radius: 0 0 8px 8px;
            z-index: 1000;
            display: none;
        }
        
        .search-result-item {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }
        
        .search-result-item:hover {
            background-color: #f8f9fa;
        }
        
        /* Form Styling */
        .form-outline {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .form-outline .form-label {
            position: absolute;
            top: 12px;
            left: 15px;
            color: #6c757d;
            transition: all 0.3s;
            pointer-events: none;
            background-color: white;
            padding: 0 5px;
            font-size: 16px;
        }
        
        .form-outline input:focus + .form-label,
        .form-outline input:not(:placeholder-shown) + .form-label {
            top: -10px;
            font-size: 12px;
            color: #3498db;
        }
        
        /* Input and Select Styling */
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            width: 100%;
            font-size: 16px;
            color: #495057;
            background-color: white;
        }
        
        /* Button Styling */
        .btn-primary {
            background-color: #3498db;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
        }
        
        .btn-outline-primary {
            color: #3498db;
            border-color: #3498db;
        }
        
        .btn-outline-primary:hover,
        .btn-outline-primary.active {
            background-color: #3498db;
            color: white;
        }
        
        /* Hidden Fields */
        .hidden-field {
            display: none;
        }
    </style>
</head>
<body>
    <main>
        <section class="vh-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color: #3498db;">Sign up</p>

                                        <!-- Registration Options -->
                                        <div class="mb-4 text-center">
                                            <button type="button" class="btn btn-outline-primary mx-2 active" id="manualRegisterBtn">UMSB Personnel</button>
                                            <button type="button" class="btn btn-outline-primary mx-2" id="universityRegisterBtn">University Admin</button>
                                        </div>

                                        <!-- Manual Registration Form -->
                                        <form id="manualRegisterForm" class="mx-1 mx-md-4" method="POST" action="{{ route('registration.post') }}">
                                            @csrf
                                            <input type="hidden" name="registration_type" value="manual">
                                            <!-- Your existing manual registration fields -->
                                        </form>

                                        <!-- University Registration Form -->
                                        <form id="universityRegisterForm" class="mx-1 mx-md-4" method="POST" action="{{ route('registration.post') }}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="registration_type" value="university">

                                            <!-- University Search Field -->
                                            <div class="search-container">
                                                <div class="form-outline">
                                                    <input type="text" id="universitySearch" class="form-control" placeholder="Search for a university..." autocomplete="off">
                                                    <label class="form-label" for="universitySearch">Search University</label>
                                                </div>
                                                <div class="search-results" id="universityResults"></div>
                                                <input type="hidden" name="uni_id" id="selectedUniversityId">
                                            </div>

                                            <!-- Admin Search Field -->
                                            <div class="search-container">
                                                <div class="form-outline">
                                                    <input type="text" id="adminSearch" class="form-control" placeholder="Search for an admin..." autocomplete="off" disabled>
                                                    <label class="form-label" for="adminSearch">Search Admin</label>
                                                </div>
                                                <div class="search-results" id="adminResults"></div>
                                                <input type="hidden" name="admin_id" id="selectedAdminId">
                                            </div>

                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                <button type="submit" class="btn btn-primary btn-lg px-5">Register</button>
                                            </div>
                                        </form>

                                        <div class="text-center mt-3">
                                            <p>Already have an account? <a href="{{ route('login') }}" style="color: #3498db;">Login here</a></p>
                                        </div>
                                    </div>

                                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                        <img src="{{ asset('images/Registration.jpg') }}" class="img-fluid" alt="Registration illustration">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // University data from server
            const universities = {!! json_encode($universities->toArray()) !!};
            let filteredAdmins = [];
            
            // Toggle registration forms
            $('#manualRegisterBtn').on('click', function() {
                $('#manualRegisterForm').show();
                $('#universityRegisterForm').hide();
                $(this).addClass('active');
                $('#universityRegisterBtn').removeClass('active');
            });

            $('#universityRegisterBtn').on('click', function() {
                $('#manualRegisterForm').hide();
                $('#universityRegisterForm').show();
                $(this).addClass('active');
                $('#manualRegisterBtn').removeClass('active');
            });

            // University search functionality
            $('#universitySearch').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                const resultsContainer = $('#universityResults');
                
                if (searchTerm.length < 2) {
                    resultsContainer.hide().empty();
                    return;
                }
                
                const filtered = universities.filter(uni => 
                    uni.name.toLowerCase().includes(searchTerm)
                    .slice(0, 5); // Limit to 5 results
                
                resultsContainer.empty();
                
                if (filtered.length > 0) {
                    filtered.forEach(uni => {
                        resultsContainer.append(
                            `<div class="search-result-item" data-id="${uni.uni_id}">${uni.name}</div>`
                        );
                    });
                    resultsContainer.show();
                } else {
                    resultsContainer.hide();
                }
            });
            
            // Handle university selection
            $(document).on('click', '#universityResults .search-result-item', function() {
                const uniId = $(this).data('id');
                const uniName = $(this).text();
                
                $('#universitySearch').val(uniName);
                $('#selectedUniversityId').val(uniId);
                $('#universityResults').hide();
                
                // Enable admin search
                $('#adminSearch').prop('disabled', false);
                $('#adminSearch').focus();
                
                // Load admins for this university
                $.get('{{ route("get.university.admins") }}', { uni_id: uniId }, function(data) {
                    filteredAdmins = data;
                });
            });
            
            // Admin search functionality
            $('#adminSearch').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                const resultsContainer = $('#adminResults');
                
                if (searchTerm.length < 2) {
                    resultsContainer.hide().empty();
                    return;
                }
                
                const filtered = filteredAdmins.filter(admin => 
                    `${admin.first_name} ${admin.last_name}`.toLowerCase().includes(searchTerm))
                    .slice(0, 5); // Limit to 5 results
                
                resultsContainer.empty();
                
                if (filtered.length > 0) {
                    filtered.forEach(admin => {
                        resultsContainer.append(
                            `<div class="search-result-item" data-id="${admin.admin_id}">
                                ${admin.first_name} ${admin.last_name} (${admin.email_address})
                            </div>`
                        );
                    });
                    resultsContainer.show();
                } else {
                    resultsContainer.hide();
                }
            });
            
            // Handle admin selection
            $(document).on('click', '#adminResults .search-result-item', function() {
                const adminId = $(this).data('id');
                const adminName = $(this).text();
                
                $('#adminSearch').val(adminName);
                $('#selectedAdminId').val(adminId);
                $('#adminResults').hide();
            });
            
            // Hide results when clicking elsewhere
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-container').length) {
                    $('.search-results').hide();
                }
            });
        });
    </script>
</body>
</html>