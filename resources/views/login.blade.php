<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMSB</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="{{ asset('images/login image.png') }}" class="img-fluid" alt="Login illustration">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
                               placeholder="Enter a valid email address" required />
                        <label class="form-label" for="form3Example3">Email address</label>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                               placeholder="Enter password" required />
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" />
                            <label class="form-check-label" for="remember"> Remember me </label>
                        </div>
                        <a href="#" class="text-body">Forgot password?</a>
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg px-5">Login</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?
                            <a href="#" class="link-danger">Register</a>
                        </p>
                    </div>
                </form>
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
