<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart-Folio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f8fc;
            color: #333;
            overflow-x: hidden;
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.9);
            padding: 15px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-100%);
            animation: slideIn 0.8s forwards;
        }

        @keyframes slideIn {
            to {
                transform: translateY(0);
            }
        }

        nav a {
            color: white;
            font-size: 16px;
            font-weight: 500;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #FFD700;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #FFD700;
        }

        .nav-buttons a {
            padding: 10px 20px;
            border-radius: 5px;
            margin-left: 10px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .nav-buttons a.login-btn {
            background-color: transparent;
            border: 2px solid #FFD700;
            color: #FFD700;
        }

        .nav-buttons a.login-btn:hover {
            background-color: #FFD700;
            color: black;
            transform: scale(1.1);
        }

        .nav-buttons a.signup-btn {
            background-color: #FFD700;
            color: black;
        }

        .nav-buttons a.signup-btn:hover {
            background-color: #FFC107;
            transform: scale(1.1);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6)), url('/images/home.jpg') no-repeat center center / cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            animation: fadeIn 1.2s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .hero h1 {
            font-size: 64px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #FFD700;
            text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.7);
            animation: scaleUp 1s forwards;
        }

        @keyframes scaleUp {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .hero p {
            font-size: 24px;
            margin-bottom: 30px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
            animation: fadeInText 1.5s ease-out;
        }

        @keyframes fadeInText {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .cta-buttons a {
            padding: 15px 30px;
            margin: 0 10px;
            font-size: 18px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .cta-buttons a.login-btn {
            background-color: transparent;
            border: 2px solid #FFD700;
            color: #FFD700;
        }

        .cta-buttons a.login-btn:hover {
            background-color: #FFD700;
            color: black;
            transform: scale(1.1);
        }

        .cta-buttons a.signup-btn {
            background-color: #FFD700;
            color: black;
        }

        .cta-buttons a.signup-btn:hover {
            background-color: #FFC107;
            transform: scale(1.1);
        }

        /* Quote Section */
        .quote {
            position: absolute;
            bottom: 10%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 215, 0, 0.8);
            padding: 10px 30px;
            border-radius: 8px;
            font-style: italic;
            font-size: 18px;
            text-align: center;
            color: black;
            animation: bounceIn 1s ease-in-out;
        }

        @keyframes bounceIn {
            0% {
                transform: translateY(200px);
            }
            60% {
                transform: translateY(-20px);
            }
            80% {
                transform: translateY(10px);
            }
            100% {
                transform: translateY(0);
            }
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            opacity: 0;
            animation: fadeInFooter 1.5s forwards;
        }

        @keyframes fadeInFooter {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        footer a {
            color: #FFD700;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #FFC107;
        }

        footer p {
            margin: 5px 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 48px;
            }

            .hero p {
                font-size: 18px;
            }

            .cta-buttons a {
                font-size: 16px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="d-flex justify-content-between align-items-center">
        <a href="#" class="navbar-brand">Smart-Folio</a>
        <div class="nav-links">
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </div>
        <div class="nav-buttons">
            <a href="{{url('login')}}" class="login-btn">Login</a>
            <a href="{{url('register')}}" class="signup-btn">Sign Up</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1>Smart-Folio</h1>
            <p>Track. Manage. Grow Your Investments.</p>
            <div class="cta-buttons">
                <a href="{{url('login')}}" class="login-btn">Login</a>
                <a href="{{url('register')}}" class="signup-btn">Sign Up</a>
            </div>
        </div>
        <div class="quote">"The market reward greed but teaches patience"</div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Smart-Folio. All Rights Reserved.</p>
        <p><a href="#about">About</a> | <a href="#contact">Contact</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
