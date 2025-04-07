<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - UMSB</title>
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<section class="vh-100" style="background-color: #f8f9fa;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color: #3498db;">Sign up</p>

                                <form class="mx-1 mx-md-4" method="POST" action="{{ route('registration') }}">
                                    @csrf

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw" style="color: #3498db;"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="name" name="name" class="form-control" required />
                                            <label class="form-label" for="name">Your Name</label>
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

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="{{ asset('images/register-image.png') }}" class="img-fluid" alt="Registration illustration">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-4 px-4 px-xl-5 bg-primary mt-auto">
        <div class="container-fluid text-center text-white">
            &copy; 2024 UMSB. All rights reserved.
        </div>
    </footer>
</section>
</body>
</html>