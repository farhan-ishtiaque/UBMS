<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMSB - Universities of Bangladesh</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    @vite(['resources/css/homepage.css'])git
</head>
<body>
    <header>
        <div class="container">
            <h1 class="logo">UMSB</h1>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="hero">
            <div class="container">
                <h1>Universities of Bangladesh</h1>
                <h2>UMSB</h2>
                <p>A platform to manage and explore the universities of Bangladesh</p>
                <button class="cta-button">Get Started</button>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 UMSB. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>