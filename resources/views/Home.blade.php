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
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            overflow-x: hidden;
        }

        /* Navbar Styles */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.8); /* Transparent black */
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
            background-image: url('/images/home.JPG');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .hero::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Dark overlay */
    z-index: 0;
    filter: blur(2px);
    pointer-events: none; /* Allow clicks to pass through */
}

.hero h1,
.hero p,
.cta-buttons,
.quote {
    position: relative;
    z-index: 1; /* Higher than the pseudo-element */
}

        .hero h1 {
            font-size: 70px;
            font-weight: 800;
            margin-bottom: 20px;
            z-index: 1;
            color:aqua; /* Gold for prominence */
        }

        .hero p {
            font-size: 28px;
            font-weight: bold;
            z-index: 1;
            color: aqua;
            margin-bottom: 40px;
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

        .quote {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-style: italic;
            font-size: 20pxpx;
            z-index: 1;
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

        /* Responsive Styles */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 50px;
            }

            .hero p {
                font-size: 20px;
            }

            .cta-buttons {
                flex-direction: column;
                gap: 15px;
            }

            nav {
                flex-wrap: wrap;
            }

            nav .nav-links a {
                font-size: 14px;
                margin-right: 5px;
            }

            nav .search-box input {
                width: 120px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="nav-links">
            <a href="{{url('login')}}">User login</a>
            <a href="{{url('loginad')}}">Admin Login</a>
            <a href="{{url('register')}}">Signup</a>
            <a href="#about">About</a>
            <a href="#">Contact us</a>
        </div>
        <div class="search-box">
            <input type="text" placeholder="Search...">
            <button><img src="https://img.icons8.com/material-outlined/24/search.png" alt="Search"></button>
        </div>
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
        <div class="quote">
            "Every loss is a lesson, and every gain is the test. The market doesn't reward greed but teaches patience."
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Smart-Folio. All Rights Reserved.</p>
        <p>For more information, visit our <a href="#about">About</a> section.</p>
    </footer>

    <script>
        // Placeholder for interactive JavaScript if needed
    </script>
</body>
</html>
