<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart-Folio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* Navbar Styles */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin-right: 10px;
            font-weight: bold;
            font-size: 16px;
        }

        nav .nav-links a:hover {
            background-color: #5E35B1;
            border-radius: 4px;
        }

        nav .search-box {
            position: relative;
        }

        nav .search-box input {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            outline: none;
        }

        nav .search-box button {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #333;
        }

        /* Hero Section */
        .hero {
            position: relative;
            background-image: url('/images/home.jpg');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            align-text: center;
            overflow: hidden;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .hero img {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

        /* Apply blur effect only to the background */
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: inherit;
            background-size: inherit;
            background-position: inherit;
            filter: blur(1px);
            z-index: -1;
        }

        /* Hero content */
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            animation: fadeIn 5s ease-in-out;
            color: white;
        }

        .hero h1 {
            font-size: 70px;
            font-weight: 800;
            margin-bottom: 20px;
            color: aqua;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8);
            animation: colorChange 5s infinite linear;
        }

        @keyframes colorChange {
            0% { color: aqua; }
            25% { color: gold; }
            50% { color: red; }
            75% { color: lime; }
            100% { color: aqua; }
        }

        .hero p {
            font-size: 28px;
            font-weight: bold;
            color: white;
            margin-bottom: 40px;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.6);
            animation: colorChange 5s infinite linear;
        }

        /* Quote Section */
        .quote {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            font-size: 20px;
            font-style: italic;
            color: #FFD700;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background to make text readable */
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .cta-buttons a {
            text-decoration: none;
            padding: 15px 30px;
            background-color: #673AB7;
            color: white;
            font-weight: bold;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .cta-buttons a:hover {
            background-color: #5E35B1;
        }

        /* Footer Section */
        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            font-size: 14px;
        }

        footer a {
            color: #FFD700;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="nav-links">
            <a href="{{url('login')}}">User Login</a>
            <a href="{{url('loginad')}}">Admin Login</a>
            <a href="{{url('register')}}">Signup</a>
            <a href="#about">About</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="search-box">
            <input type="text" placeholder="Search...">
            <button><img src="https://img.icons8.com/material-outlined/24/search.png" alt="Search"></button>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-content">
            <h1>Smart-Folio</h1>
            <p>Your Investment Tracker</p>
            <div class="cta-buttons">
                <a href="{{url('login')}}">Login</a>
                <a href="{{url('register')}}">Sign Up</a>
            </div>
        </div>
        <!-- Quote Section in Front of the Image -->
        <div class="quote">
            "Every Loss is a lesson and every gain is the <br>
            The market doesn't reward greed but teaches patience"
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Smart-Folio. All Rights Reserved.</p>
        <p>For more information, visit our <a href="#about">About</a> section.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
