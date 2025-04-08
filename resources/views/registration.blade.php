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
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
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
                                        <button class="btn btn-outline-primary" id="manualRegisterBtn">Manual Register</button>
                                        <button class="btn btn-outline-primary" id="universityRegisterBtn">Register from Universities</button>
                                    </div>

                                    <!-- Manual Registration Form -->
                                    <form id="manualRegisterForm" class="mx-1 mx-md-4" method="POST" action="{{ route('university.registration.post') }}" style="display: none;">
                                        @csrf

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
                                                <label class="form-label" for="password_confirmation">Repeat your password</label>
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" id="terms" required />
                                            <label class="form-check-label" for="terms">
                                                I agree all statements in <a href="#!" style="color: #3498db;">Terms of service</a>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg px-5" style="background-color: #3498db; border: none;">
                                                Register
                                            </button>
                                        </div>
                                    </form>

                                    <!-- University Registration Form -->
                                    <form id="universityRegisterForm" class="mx-1 mx-md-4" method="POST" action="{{ route('university.registration.post') }}" style="display: none;">
                                        @csrf

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-university fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <select id="university" name="university" class="form-control" required>
                                                    <option value="">Select University</option>
                                                    @foreach($universities as $university)
                                                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label class="form-label" for="university">University</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <select id="uniAdmin" name="uniAdmin" class="form-control" required>
                                                    <option value="">Select University Admin</option>
                                                </select>
                                                <label class="form-label" for="uniAdmin">University Admin</label>
                                            </div>
                                        </div>

                                        <input type="hidden" name="FirstName" id="firstNameUni" value="" />
                                        <input type="hidden" name="LastName" id="lastNameUni" value="" />
                                        <input type="hidden" name="PhoneNumber" id="phoneNumberUni" value="" />
                                        <input type="hidden" name="email" id="emailUni" value="" />
                                        <input type="hidden" name="password" value="password" />
                                        <input type="hidden" name="type" value="university_admin" />

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg px-5" style="background-color: #3498db; border: none;">
                                                Register
                                            </button>
                                        </div>
                                    </form>

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



<script>
    document.getElementById('manualRegisterBtn').onclick = function () {
        document.getElementById('manualRegisterForm').style.display = 'block';
        document.getElementById('universityRegisterForm').style.display = 'none';
    };

    document.getElementById('universityRegisterBtn').onclick = function () {
        document.getElementById('manualRegisterForm').style.display = 'none';
        document.getElementById('universityRegisterForm').style.display = 'block';
    };

    document.getElementById('university').addEventListener('change', function () {
        const universityId = this.value;
        const uniAdmins = {
            1: [{ id: 1, name: 'Admin 1' }, { id: 2, name: 'Admin 2' }],
            2: [{ id: 3, name: 'Admin 3' }, { id: 4, name: 'Admin 4' }]
        };

        const uniAdminSelect = document.getElementById('uniAdmin');
        uniAdminSelect.innerHTML = '<option value="">Select University Admin</option>';

        if (universityId in uniAdmins) {
            uniAdmins[universityId].forEach(admin => {
                const option = document.createElement('option');
                option.value = admin.id;
                option.textContent = admin.name;
                uniAdminSelect.appendChild(option);
            });
        }
    });
</script>
</body>
</html>
