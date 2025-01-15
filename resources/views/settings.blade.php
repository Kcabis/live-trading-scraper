@extends('portfolio')

@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush

@section('content')
    <div class="container">
        <!-- Profile Section -->
        <div class="profile-section">
            <img src="profile-pic.jpg" alt="User Profile" id="profile-img">
            <input type="file" class="file-upload" id="upload-profile" accept="image/*">
            <h2>User Profile</h2>
        </div>

        <!-- Forms Section -->
        <div class="form-box">
            <!-- User Details Form -->
            <div class="box">
                <h2>User Details</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="JohnDoe">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="johndoe@example.com">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" value="1234567890">
                </div>
                <div class="form-group">
                    <button type="submit">Update Details</button>
                </div>
            </div>

            <!-- Change Password Form -->
            <div class="box">
                <h2>Change Password</h2>
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
                    <input type="password" id="confirm-password" name="confirm-password">
                </div>
                <div class="form-group">
                    <button type="submit">Change Password</button>
                </div>

                <!-- Forgot & Logout Links -->
                <div class="link-options">
                    <a href="#">Forgot Password?</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // JavaScript to handle the profile image upload
        document.getElementById('upload-profile').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    document.getElementById('profile-img').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
