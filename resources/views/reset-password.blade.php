<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        button, a {
            text-decoration: none;
            color: #fff;
            background-color: #e74c3c;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover, a:hover {
            background-color: #c0392b;
        }

        /* Reset Password Container */
        .reset-password-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .reset-password-container h2 {
            font-size: 28px;
            color: #34495e;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .input-group {
            margin-bottom: 15px;
            width: 100%;
            text-align: left;
        }

        .input-group label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        .input-group input:focus {
            border-color: #2980b9;
            background-color: #fff;
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

        /* Button Styling */
        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #e74c3c;
            border-radius: 5px;
            color: #fff;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #c0392b;
        }

        /* Back Link */
        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            background-color: #34495e;
            padding: 10px 20px;
            border-radius: 5px;
            color: #fff;
        }

        .back-link a:hover {
            background-color: #2c3e50;
        }
    </style>
</head>
<body>
    <button id="back"><a href="{{ url('home') }}">Back</a></button>
    <div class="reset-password-container">
        <h2>Reset Your Password</h2>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ old('email') }}">
        
            <div class="input-group">
                <label for="password">New Password</label>
                <input type="password" name="password" required>
            </div>
        
            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>
        
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        
            <button type="submit">Reset Password</button>
        </form>
        

        <div class="back-link">
            <a href="{{ url('login') }}">Back to Login</a>
        </div>
    </div>
</body>
</html>
