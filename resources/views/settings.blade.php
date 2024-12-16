@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush

@section('content')
    <h2>Settings</h2>
    <!-- Dashboard content goes here -->

            <!-- Settings Section -->
            <div id="settingsSection" class="content-section" style="display: none;">
                <h2>Settings</h2>
                <div class="profile-container">
                    <img id="profileImage" class="profile-img" src="default-profile.png" alt="Profile Image" />
                    <button id="editProfileButton" class="edit-profile-btn">Edit</button>
                </div>
                <div class="user-details">
                    <h3>User Details</h3>
                    <form id="userDetailsForm">
                        <label for="username">Username</label>
                        <label for="email">Email</label>
                        <label for="phone">Phone No.</label>
                    </form>
                </div>
                <div class="change-password">
                    <h3>Change Password</h3>
                    <form id="passwordForm">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword"
                            placeholder="Enter current password" />

                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" />

                        <label for="retypePassword">Retype Password</label>
                        <input type="password" id="retypePassword" name="retypePassword"
                            placeholder="Retype new password" />
                    </form>
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

        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
