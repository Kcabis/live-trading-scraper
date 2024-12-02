<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart-Folio - Login</title>
    <style>
        /* General styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        /* Full-width background image */
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://source.unsplash.com/1920x1080/?technology,finance') no-repeat center center/cover;
            z-index: -1;
        }

        /* Back button */
        #back {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #673AB7;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            z-index: 10;
        }

        #back a {
            text-decoration: none;
            color: white;
        }

        #back:hover {
            background-color: #5E35B1;
        }

        /* Login container */
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        .login-box .logo h2 {
            font-size: 28px;
            color: #673AB7;
            margin-bottom: 10px;
        }

        .login-box h4 {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }

        .input-group img {
            padding: 10px;
            background: #f4f4f4;
            border-right: 1px solid #ddd;
        }

        .input-group input {
            flex: 1;
            border: none;
            padding: 10px;
            outline: none;
        }

        .show-password {
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            justify-content: start;
            margin-bottom: 15px;
        }

        .remember-me input {
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #673AB7;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #5E35B1;
        }

        .additional-options {
            margin-top: 15px;
        }

        .additional-options a {
            color: #673AB7;
            text-decoration: none;
            margin: 0 10px;
        }

        .additional-options a:hover {
            text-decoration: underline;
        }

        hr {
            margin: 20px 0;
        }

        p a {
            color: #673AB7;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <button id="back"><a href="{{ url('home') }}">Back</a></button>
    <div class="background-image"></div>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <h2>Smart-Folio</h2>
            </div>
            <h4>Portfolio Management System</h4>
            
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email"><img src="https://img.icons8.com/material-outlined/24/000000/secured-letter.png"/></label>
                    <input type="email" name="email" id="email" placeholder="Email Address" required>
                </div>
                <div class="input-group">
                    <label for="password"><img src="https://img.icons8.com/material-outlined/24/000000/lock-2.png"/></label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <button type="button" class="show-password" onclick="togglePassword()"><img src="https://img.icons8.com/material-outlined/24/000000/visible.png"/></button>
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn-primary">Sign In</button>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
        }
    </script>
</body>
</html>
