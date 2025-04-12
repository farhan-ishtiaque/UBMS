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
        html, body { height: 100%; }
        body { display: flex; flex-direction: column; }
        main { flex: 1; }
        .form-outline label { transition: all 0.3s ease; }
        .form-outline input:focus + label,
        .form-outline input:not(:placeholder-shown) + label,
        .form-outline select:focus + label,
        .form-outline select:not(:value="") + label {
            transform: translateY(-1.25rem) scale(0.8);
            background-color: white;
            padding: 0 0.5rem;
            color: #3498db;
        }
    </style>
</head>
<body>
<main>
    <section class="vh-100" style="background-color: #f8f9fa;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color: #3498db;">Sign up</p>

                                    <!-- Registration Options -->
                                    <div class="mb-4 text-center">
                                        <button type="button" class="btn btn-outline-primary mx-2" id="manualRegisterBtn">UMSB Personnel</button>
                                        <button type="button" class="btn btn-outline-primary mx-2" id="universityRegisterBtn">University Admin</button>
                                    </div>

                                    <!-- Manual Registration Form -->
                                    <form id="manualRegisterForm" class="mx-1 mx-md-4" method="POST" action="{{ route('registration.post') }}" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="registration_type" value="manual">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="firstName" name="FirstName" class="form-control" required />
                                                <label class="form-label" for="firstName">First Name</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="lastName" name="LastName" class="form-control" required />
                                                <label class="form-label" for="lastName">Last Name</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-phone fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="phoneNumber" name="PhoneNumber" class="form-control" required />
                                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="email" name="email" class="form-control" required />
                                                <label class="form-label" for="email">Your Email</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="password" name="password" class="form-control" required />
                                                <label class="form-label" for="password">Password</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required />
                                                <label class="form-label" for="password_confirmation">Repeat Password</label>
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" id="terms" required />
                                            <label class="form-check-label" for="terms">
                                                I agree to the <a href="#!" style="color: #3498db;">Terms of Service</a>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg px-5" style="background-color: #3498db; border: none;">
                                                Register
                                            </button>
                                        </div>
                                    </form>

                                    <!-- University Registration Form -->
                                    <form id="universityRegisterForm" class="mx-1 mx-md-4" method="POST" action="{{ route('registration.post') }}" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="registration_type" value="university">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-university fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <select id="uni_id" name="uni_id" class="form-control" required>
                                                    <option value="">Select University</option>
                                                    @foreach($universities as $university)
                                                        <option value="{{ $university->uni_id }}">{{ $university->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label class="form-label" for="uni_id">University</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user-tie fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <select id="admin_id" name="admin_id" class="form-control" required>
                                                    <option value="">Select University Admin</option>
                                                </select>
                                                <label class="form-label" for="admin_id">University Admin</label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg px-5" style="background-color: #3498db; border: none;">
                                                Register
                                            </button>
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
    // Toggle between registration forms
    document.getElementById('manualRegisterBtn').addEventListener('click', function() {
        document.getElementById('manualRegisterForm').style.display = 'block';
        document.getElementById('universityRegisterForm').style.display = 'none';
        this.classList.add('active');
        document.getElementById('universityRegisterBtn').classList.remove('active');
    });

    document.getElementById('universityRegisterBtn').addEventListener('click', function() {
        document.getElementById('manualRegisterForm').style.display = 'none';
        document.getElementById('universityRegisterForm').style.display = 'block';
        this.classList.add('active');
        document.getElementById('manualRegisterBtn').classList.remove('active');
    });

    // Load university admins when university is selected
    $('#uni_id').change(function() {
        const uniId = $(this).val();
        if (uniId) {
            $.get('{{ route("get.university.admins") }}', { uni_id: uniId }, function(data) {
                $('#admin_id').empty();
                $('#admin_id').append('<option value="">Select University Admin</option>');
                data.forEach(admin => {
                    $('#admin_id').append(`<option value="${admin.admin_id}">${admin.first_name} ${admin.last_name} (${admin.email_address})</option>`);
                });
            });
        } else {
            $('#admin_id').empty();
            $('#admin_id').append('<option value="">Select University Admin</option>');
        }
    });

    // Floating labels functionality
    document.querySelectorAll('.form-outline input, .form-outline select').forEach(element => {
        element.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.value) {
                label.classList.add('active');
            } else {
                label.classList.remove('active');
            }
        });

        // Trigger change event on page load if there's a value
        if (element.value) {
            element.dispatchEvent(new Event('change'));
        }
    });
</script>
</body>
</html>