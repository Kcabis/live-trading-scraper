<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ url('css/login.css') }}">

</head>
<body>
<button id="back"><a href="{{url('home')}}">Back</a></button>
    <div class="background-image"></div>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <h2>Smart-folio</h2>
            </div>
            <h4>Portfolio management system</h4>
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
        <input type="email" name="email" id="email" placeholder="Please sign-in to your account" required>
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

            <div class="additional-options">
                <a href="#">Forgot Password?</a>
                <a href="#">Reset Password</a>
            </div>
            <hr>
            <p>New on our platform? <a href="{{ url('/registration') }}">Create new account</a></p>
        </div>
    </div>
</body>
</html>
<script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
        }
    </script>
