<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .register-box {
            width: 100%;
        }

        .register-box h3 {
            text-align: center;
            color: #4A4A4A;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .register-box p {
            text-align: center;
            color: #7A7A7A;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .input-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .input-group {
            flex: 1 1 48%;
            margin-bottom: 10px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #4A4A4A;
            font-size: 14px;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .input-group input:focus {
            border-color: #673AB7;
            outline: none;
        }

        .terms {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .terms input {
            margin-right: 10px;
        }

        .terms a {
            color: #673AB7;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #673AB7;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #5E35B1;
        }

        .register-box p {
            text-align: center;
            color: #555;
        }

        .register-box p a {
            color: #673AB7;
            text-decoration: none;
        }

        .register-box p a:hover {
            text-decoration: underline;
        }

        /* Back button */
        .back-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 8px 12px;
            background-color: #673AB7;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #5E35B1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .input-row {
                flex-direction: column;
            }

            .input-group {
                flex: 1 1 100%;
            }
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 15px;
            }

            .register-box h3 {
                font-size: 20px;
            }

            .input-group input {
                padding: 10px;
            }

            .btn-primary {
                font-size: 14px;
            }

        }
    </style>

</head>

<body>
    <div class="register-container">
        <button id="back"><a href="{{url('home')}}">Back</a></button>
        <div class="register-box">
            <h3>OTP</h3>
            <p>Enter the OTP you got</p>
            @if($errors->any())
                <p style="color: red;">{{ $errors->first() }}</p>
            @endif
            <form id="registerForm" method="POST" action="{{ url('/otp-verification') }}">
                @csrf
                <div class="input-row">
                    <div class="input-group">
                        <input type="hidden" name="email" value="{{ $email }}">
                        <label for="first-name">OTP*</label>
                        <input type="text" id="first-name" name="otp" value="{{ old('otp') }}"
                            placeholder="OTP" required>
                        @error('otp') <small style="color:red;">{{ $message }}</small> @enderror
                    </div>
                </div>

                <button type="submit" class="btn-primary">Submit</button>
            </form>

            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            <p>Already a Member? <a href="{{url('login')}}">Login</a></p>
        </div>
    </div>

</body>

</html>