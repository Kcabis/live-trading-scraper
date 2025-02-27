<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
                
                <!-- Password Visibility Toggle -->
                <div class="show-password-checkbox">
                    <input type="checkbox" id="show-password" onclick="togglePassword()"> 
                    <label for="show-password">Show Passwords</label>
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

    <script>
        // Toggle password visibility function
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirm-password');
            const showPasswordCheckbox = document.getElementById('show-password');

            if (showPasswordCheckbox.checked) {
                passwordField.type = "text";
                confirmPasswordField.type = "text";
            } else {
                passwordField.type = "password";
                confirmPasswordField.type = "password";
            }
        }
    </script>
</body>
</html>
