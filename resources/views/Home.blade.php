<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart-Folio</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        /* Navbar Styles */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(103, 58, 183, 0.9); /* Transparent purple */
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin-right: 20px;
            font-weight: bold;
            font-size: 16px;
        }

        nav a:hover {
            background-color: #5E35B1;
            border-radius: 4px;
        }

        /* Hero Section (Full Background Image) */
        .hero {
            position: relative;
            background-image: url('https://source.unsplash.com/1600x900/?business,finance');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            z-index: 1;
        }

        .hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay for better readability */
            z-index: 0;
        }

        .hero h1 {
            font-size: 60px;
            font-weight: 700;
            margin-bottom: 20px;
            z-index: 1;
        }

        .hero p {
            font-size: 24px;
            margin-bottom: 30px;
            z-index: 1;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 30px;
            z-index: 1;
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
            color: #673AB7;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 45px;
            }

            .hero p {
                font-size: 18px;
            }

            .cta-buttons {
                flex-direction: column;
                gap: 15px;
            }

            nav {
                padding: 15px;
            }

            nav a {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <a href="{{url('login')}}">User Login</a>
        <a href="{{url('adminlog')}}">Admin Login</a>
        <a href="{{url('register')}}">Signup</a>
        <a href="#about">About</a>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1>Smart-Folio</h1>
            <p>Your Investment Tracker</p>
            <div class="cta-buttons">
                <a href="{{url('login')}}">Login</a>
                <a href="{{url('register')}}">Sign Up</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Smart-Folio. All Rights Reserved.</p>
        <p>For more information, visit our <a href="#about">About</a> section.</p>
    </footer>

    <script>
        // If necessary, you can add JS for smooth scroll or other interactions
    </script>
</body>
</html>
