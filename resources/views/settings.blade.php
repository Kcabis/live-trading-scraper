@extends('portfolio')

@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    <style>
        /* Animated stock market effect */
        .stock-animation {
            font-size: 20px;
            font-weight: bold;
            color: green;
            display: inline-block;
            animation: stockUp 2s infinite alternate ease-in-out;
        }

        @keyframes stockUp {
            0% { transform: translateY(0); color: green; }
            100% { transform: translateY(-5px); color: red; }
        }

        .settings-header {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .show-password-checkbox {
            margin-top: 10px;
            display: flex;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="settings-header">
            <span class="stock-animation">📈 Hello {{auth()->user()->first_name}} 📉</span>
        </div>

        <div class="form-box">
            <div class="box">
                <h2>User Details</h2>
                <form action="{{ route('settings.updateDetails') }}" method="POST" id="updateDetailsForm">
                    @csrf
                    <div class="form-group">
                        <label for="username">Hello, {{ auth()->user()->first_name ?? 'Guest' }}</label>
                        <input type="text" id="username" name="username" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone }}" required pattern="\d*" maxlength="15" oninput="validatePhone()">
                    </div>
                    <div class="form-group">
                        <button type="submit">Update Details</button>
                    </div>
                </form>
            </div>

            <div class="box">
                <h2>Change Password</h2>
                <form action="{{ route('settings.changePassword') }}" method="POST" id="changePasswordForm">
                    @csrf
                    <div class="form-group">
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" name="current-password">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new-password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" id="confirm-password" name="new-password_confirmation">
                    </div>
                    <div class="show-password-checkbox">
                        <input type="checkbox" id="show-password" onclick="togglePassword()"> 
                        <label for="show-password">Show Passwords</label>
                    </div>
                    <div class="form-group">
                        <button type="submit">Change Password</button>
                    </div>
                </form>

                <div class="link-options">
                    <a href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Phone validation function (only numbers allowed)
        function validatePhone() {
            const phoneInput = document.getElementById('phone');
            const phoneValue = phoneInput.value;
            // Allow only digits and update the value if there are any non-digit characters
            phoneInput.value = phoneValue.replace(/[^0-9]/g, '');
        }

        // Toggle password visibility function
        function togglePassword() {
            const currentPassword = document.getElementById('current-password');
            const newPassword = document.getElementById('new-password');
            const confirmPassword = document.getElementById('confirm-password');

            const showPasswordCheckbox = document.getElementById('show-password');

            // Toggle password visibility based on checkbox
            if (showPasswordCheckbox.checked) {
                currentPassword.type = "text";
                newPassword.type = "text";
                confirmPassword.type = "text";
            } else {
                currentPassword.type = "password";
                newPassword.type = "password";
                confirmPassword.type = "password";
            }
        }
    </script>
@endsection
