<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMSB - Universities of Bangladesh</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('images/UBMS logo1.png') }}" alt="UMSB Logo" class="header-logo">
                <h1 class="logo">UMSB</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h1>University Management System Of Bangladesh</h1>
                <h2>UMSB</h2>
                <p>A platform to manage and explore the universities of Bangladesh</p>
                <a href="{{ route('login') }}" class="cta-button">Login</a>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} UMSB. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
