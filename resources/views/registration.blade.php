<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
    body {
        font-family: 'Poppins',sans-serif;
        background-color: #616c82;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .background-image {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-image: url('/images/login.JPG');
    background-size: cover;
    background-position: center;
    z-index: -1;
    filter: blur(5px);
}
    .register-container {
        background-color: rgba(36, 47, 73, 0.8);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 600px;

    }

    .register-box h3 {
        text-align: center;
        color: #00d084;
        font-size: 28px;
        margin-bottom: 15px;
        font-weight: 600px;
    }

    .register-box p {
        text-align: center;
        color:rgb(255, 255, 255);
        font-size: 16px;
        margin-bottom: 30px;
    }

    .input-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    

    .input-group label {
        display: flex;
        margin-bottom: 5px;
        color:rgb(255, 255, 255);
        font-size: 14px;
    }

   
    .input-group select,
    .input-group input{
    display: flex;
    border: none;
    font-size: 14px;
    outline: none;
    color: #fff;
    background: transparent;
    align-items: center;
    margin-bottom: -9px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 6px;
    padding: 10px;
    width: 270px;
    }

    .input-group input:focus,
    .input-group select:focus {
        border-color: #673AB7;
        outline: none;
    }

    .terms {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    .terms label {
        color: #fff;
        font-size: 14px;
    }
    .terms input {
        margin-right: 10px;
    }

    .terms a {
        color: #00d084;
        text-decoration: none;
    }

    .terms a:hover {
        text-decoration: underline;
    }

    .btn-primary {
        width: 100%;
    padding: 12px;
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3sease;
    }

    .btn-primary:hover {
    background: linear-gradient(45deg, #2575fc, #6a11cb);
    transform: scale(1.05);
}

    .register-box p {
        text-align: center;
        color:#ffffff;
    }

    .register-box p a {
        color: #00d084;
        text-decoration: none;
    }

    .register-box p a:hover {
        text-decoration: underline;
    }

    .back-btn {
        position: absolute;
        top: 20px;
        left: 20px;
        padding: 10px 15px;
        background-color: #673AB7;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none;
        font-weight: bold;
    }

    .back-btn:hover {
        background-color: #5E35B1;
    }

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
            padding: 20px;
        }

        .register-box h3 {
            font-size: 24px;
        }

        .input-group input {
            padding: 12px;
        }

        .btn-primary {
            font-size: 14px;
        }
    }
</style>
</head>
<body>
<div class="background-image"></div>
    <div class="register-container">
        <a href="{{url('home')}}" class="back-btn">Back</a>
 
        <div class="register-box">
            <h3>Registration Form</h3>
            <p>Enter your information to register Smart-folio</p>
            <form id="registerForm" method="POST" action="{{ url('/register') }}">
                @csrf
                <div class="input-row">
                    <div class="input-group">
                        <label for="first-name">First Name *</label>
                        <input type="text" id="first-name" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required>
                        @error('first_name') <small style="color:red;">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-group">
                        <label for="last-name">Last Name *</label>
                        <input type="text" id="last-name" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>
                        @error('last_name') <small style="color:red;">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                        @error('email') <small style="color:red;">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-group">
                        <label for="mobile">Mobile No. *</label>
                        <input type="text" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="98XXXXXXXX" required>
                        @error('mobile') <small style="color:red;">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        @error('password') <small style="color:red;">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-group">
                        <label for="confirm-password">Confirm Password *</label>
                        <input type="password" id="confirm-password" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="terms">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree to the <a href="#">Terms of Service and Privacy Policy</a></label>
                </div>
                <button type="submit" class="btn-primary">Register</button>
            </form>

            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            <p>Already a Member? <a href="{{url('login')}}">Login</a></p>
        </div>
    </div>
</body>
</html>
