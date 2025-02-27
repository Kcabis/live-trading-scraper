<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        /* General body settings */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }

        /* Styling for the back button */
        #back {
            background-color: #34495e;
            padding: 10px 20px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            margin: 20px;
        }

        #back:hover {
            background-color: #e74c3c;
        }

        /* Forgot Password Background Image */
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('path/to/your/image.jpg') no-repeat center center/cover;
            opacity: 0.2;
        }

        /* Forgot Password Container */
        .forgot-password-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* Box to contain form elements */
        .forgot-password-box {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Logo and Header Styling */
        .logo h2 {
            font-size: 36px;
            font-weight: bold;
            color: #34495e;
        }

        h4 {
            font-size: 18px;
            color: #34495e;
            margin-bottom: 20px;
        }

        /* Input Fields */
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
        }

        .input-group input {
            width: 100%;
            padding: 15px;
            padding-left: 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f4f7fc;
        }

        .input-group input:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Error Messages */
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #e74c3c;
            color: #fff;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #c0392b;
        }

        /* Additional Options (Back to Login link) */
        .additional-options a {
            color: #3498db;
            text-decoration: none;
            font-size: 16px;
            margin-top: 15px;
        }

        .additional-options a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <button id="back"><a href="{{url('home')}}">Back</a></button>
    <div class="background-image"></div>
    <div class="forgot-password-container">
        <div class="forgot-password-box">
            <div class="logo">
                <h2>Smart-folio</h2>
            </div>
            <h4>Portfolio management system</h4>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email"><img src="https://img.icons8.com/material-outlined/24/000000/secured-letter.png"/></label>
                    <input type="email" name="email" id="email" placeholder="Please enter your email" required>
                </div>

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn-primary">Send Reset Link</button>
            </form>

            <div class="additional-options">
                <a href="{{ url('login') }}">Back to Login</a>
            </div>
        </div>
    </div>
</body>
</html>
