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

    <script>
        const form = document.getElementById('registerForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Form validation logic
            const firstName = document.getElementById('first-name').value;
            const lastName = document.getElementById('last-name').value;
            const email = document.getElementById('email').value;
            const mobile = document.getElementById('mobile').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const termsChecked = document.getElementById('terms').checked;

            // Basic validation checks
            if (!termsChecked) {
                alert("You must agree to the terms and conditions.");
                return;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return;
            }

            if (!/^\d{10}$/.test(mobile)) {
                alert("Please enter a valid 10-digit mobile number.");
                return;
            }

            if (firstName.trim() === '' || lastName.trim() === '' || email.trim() === '' || mobile.trim() === '' || password.trim() === '') {
                alert("All fields are required.");
                return;
            }

            // If form is valid
            form.submit(); // Proceed with form submission after validation
        });
    </script>
</body>
</html>
