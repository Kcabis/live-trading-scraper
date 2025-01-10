@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    <style>
        .content-section {
            margin: 20px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ccc;
        }

        .edit-profile-btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-profile-btn:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 20px;
            color: #aaa;
        }

        .close:hover {
            color: #000;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .logout-btn, .forgot-password-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn {
            background-color: #ff4d4d;
            color: white;
        }

        .forgot-password-btn {
            background-color: #17a2b8;
            color: white;
        }

        .logout-btn:hover {
            background-color: #cc0000;
        }

        .forgot-password-btn:hover {
            background-color: #0f6674;
        }
    </style>
@endpush

@section('content')
    <h2>Settings</h2>
    <!-- Settings Section -->
    <div id="settingsSection" class="content-section">
        <h2>Profile Settings</h2>
        <div class="profile-container">
            <img id="profileImage" class="profile-img" src="default-profile.png" alt="Profile Image" />
            <button id="editProfileButton" class="edit-profile-btn">Edit Profile Image</button>
        </div>
        <div class="user-details">
            <h3>User Details</h3>
            <form id="userDetailsForm">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" />
                </div>
                <div class="form-group">
                    <label for="phone">Phone No.</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" />
                </div>
            </form>
        </div>
        <div class="change-password">
            <h3>Change Password</h3>
            <form id="passwordForm">
                <div class="form-group">
                    <label for="currentPassword">Current Password</label>
                    <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter current password" />
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" />
                </div>
                <div class="form-group">
                    <label for="retypePassword">Retype Password</label>
                    <input type="password" id="retypePassword" name="retypePassword" placeholder="Retype new password" />
                </div>
            </form>
        </div>

        <div class="button-container">
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="
                    padding: 8px 12px;
                    font-size: 14px;
                    cursor: pointer;
                    background-color: #d9534f;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    font-weight: bold;
                ">Logout</button>
            </form>
        </div>
            
            <button class="forgot-password-btn">Forgot Password</button>
        </div>
    </div>

    <!-- Popup Modal -->
    <div id="imageUploadModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <h3>Upload Profile Image</h3>
            <input type="file" id="imageInput" />
            <button id="saveImageButton">Save</button>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        document.getElementById('editProfileButton').addEventListener('click', () => {
            document.getElementById('imageUploadModal').style.display = 'flex';
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('imageUploadModal').style.display = 'none';
        });

        document.querySelector('.logout-btn').addEventListener('click', () => {
            alert('You have logged out successfully.');
        });

        document.querySelector('.forgot-password-btn').addEventListener('click', () => {
            alert('Redirecting to Forgot Password page.');
        });
    </script>
@endpush
