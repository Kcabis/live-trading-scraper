@extends('portfolio')

@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="profile-section">
            <img src="{{ asset('storage/profile_images/' . (auth()->user()->profile_image ?? 'default.png')) }}" alt="User Profile" id="profile-img">
            <form action="{{ route('settings.uploadProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" class="file-upload" id="upload-profile" name="profile-image" accept="image/*">
                <button type="submit">Upload Profile Image</button>
            </form>
            <h2>User Profile</h2>
        </div>

        <div class="form-box">
            <div class="box">
                <h2>User Details</h2>
                <form action="{{ route('settings.updateDetails') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Hello {{ auth()->user()->first_name ?? 'Guest' }}</label>
                        <input type="text" id="username" name="username" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone }}">
                    </div>
                    <div class="form-group">
                        <button type="submit">Update Details</button>
                    </div>
                </form>
            </div>

            <div class="box">
                <h2>Change Password</h2>
                <form action="{{ route('settings.changePassword') }}" method="POST">
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
                    <div class="form-group">
                        <button type="submit">Change Password</button>
                    </div>
                </form>

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