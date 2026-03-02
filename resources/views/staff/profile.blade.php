@extends('layouts.app')

@section('title', 'My Profile - AutoMate')

@section('content')
@include('components.staff-navbar')

<div class="sf-prof-page">
    <main class="sf-prof-main">
        <div class="sf-prof-head">
            <h1 class="sf-prof-title">My Profile</h1>
            <p class="sf-prof-subtitle">Manage your profile information and credentials.</p>
        </div>

        @if(session('success'))
            <div class="sf-prof-flash sf-prof-flash-success">
                <div class="sf-prof-flash-row">
                    <div class="sf-prof-flash-icon-wrap">
                        <svg class="sf-prof-flash-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="sf-prof-flash-copy-wrap">
                        <p class="sf-prof-flash-copy">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="sf-prof-flash sf-prof-flash-error">
                <div class="sf-prof-flash-row">
                    <div class="sf-prof-flash-icon-wrap">
                        <svg class="sf-prof-flash-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="sf-prof-flash-copy-wrap">
                        <h3 class="sf-prof-error-title">There were errors with your submission</h3>
                        <ul class="sf-prof-error-list">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="sf-prof-grid">
            <div class="sf-prof-left-col">
                 <div class="sf-prof-account-card">
                    <div class="sf-prof-account-main">
                        <div class="sf-prof-avatar-wrap">
                            <div class="sf-prof-avatar">
                                @if($staff->profile_image)
                                    <img src="{{ asset('storage/' . $staff->profile_image) }}" alt="Profile" class="sf-prof-avatar-img">
                                @else
                                    <span class="sf-prof-avatar-initial">{{ strtoupper(substr($staff->name, 0, 1)) }}</span>
                                @endif
                            </div>
                        </div>
                        <h2 class="sf-prof-name">{{ $staff->name }}</h2>
                        <p class="sf-prof-email">{{ $staff->email }}</p>
                        <span class="sf-prof-role-badge">
                            {{ ucfirst($staff->role ?? 'Staff') }}
                        </span>
                    </div>
                    <div class="sf-prof-account-details">
                        <h3 class="sf-prof-account-title">Account Details</h3>
                        <div class="sf-prof-detail-list">
                            <div class="sf-prof-detail-row">
                                <span class="sf-prof-detail-key">Staff ID</span>
                                <span class="sf-prof-detail-value sf-prof-detail-mono">#{{ $staff->id }}</span>
                            </div>
                            <div class="sf-prof-detail-row">
                                <span class="sf-prof-detail-key">Position</span>
                                <span class="sf-prof-detail-value">{{ $staff->position ?? 'Not set' }}</span>
                            </div>
                             <div class="sf-prof-detail-row">
                                <span class="sf-prof-detail-key">Experience</span>
                                <span class="sf-prof-detail-value">{{ $staff->experience ?? 'Not set' }}</span>
                            </div>
                            <div class="sf-prof-detail-row">
                                <span class="sf-prof-detail-key">Joined</span>
                                <span class="sf-prof-detail-value">{{ $staff->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sf-prof-right-col">
                 <div class="sf-prof-form-card">
                    <div class="sf-prof-form-card-head">
                        <h3 class="sf-prof-form-card-title">Edit Profile</h3>
                    </div>
                    <div class="sf-prof-form-card-body">
                        <form method="POST" action="{{ route('staff.profile.update') }}" enctype="multipart/form-data" class="sf-prof-form">
                            @csrf
                            
                            <div>
                                <label class="sf-prof-label">Profile Photo</label>
                                <div class="sf-prof-photo-row">
                                    <div class="sf-prof-photo-preview" id="preview-container">
                                        @if($staff->profile_image)
                                            <img src="{{ asset('storage/' . $staff->profile_image) }}" id="profile-preview" class="sf-prof-photo-preview-img">
                                        @else
                                            <svg class="sf-prof-photo-placeholder" id="profile-placeholder" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        @endif
                                    </div>
                                    <div class="sf-prof-photo-upload-wrap">
                                        <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(this)" class="sf-prof-file-input">
                                        <p class="sf-prof-help-text">JPG, GIF or PNG. Max size 2MB.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sf-prof-field-grid">
                                <div>
                                    <label for="name" class="sf-prof-label">Full Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $staff->name) }}" required class="sf-prof-input">
                                </div>

                                <div>
                                    <label for="email" class="sf-prof-label">Email Address</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $staff->email) }}" required class="sf-prof-input">
                                </div>

                                <div>
                                    <label for="phone" class="sf-prof-label">Phone</label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $staff->phone) }}" class="sf-prof-input">
                                </div>

                                <div>
                                    <label for="position" class="sf-prof-label">Position</label>
                                    <input type="text" id="position" name="position" value="{{ old('position', $staff->position) }}" class="sf-prof-input">
                                </div>

                                <div>
                                    <label for="experience" class="sf-prof-label">Experience</label>
                                    <input type="text" id="experience" name="experience" value="{{ old('experience', $staff->experience) }}" class="sf-prof-input">
                                </div>
                            </div>

                            <div>
                                <label for="current_address" class="sf-prof-label">Current Address</label>
                                <textarea id="current_address" name="current_address" rows="3" class="sf-prof-input sf-prof-textarea">{{ old('current_address', $staff->current_address) }}</textarea>
                            </div>

                            <div class="sf-prof-actions-right">
                                <button type="submit" class="sf-prof-btn sf-prof-btn-primary">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                 <div class="sf-prof-form-card">
                    <div class="sf-prof-form-card-head">
                        <h3 class="sf-prof-form-card-title">Change Password</h3>
                    </div>
                    <div class="sf-prof-form-card-body">
                        <form method="POST" action="{{ route('staff.profile.password') }}" class="sf-prof-form">
                            @csrf
                            
                            <div>
                                <label for="current_password" class="sf-prof-label">Current Password</label>
                                <div class="sf-prof-password-wrap">
                                    <input type="password" id="current_password" name="current_password" required class="sf-prof-input sf-prof-password-input">
                                    <button type="button" onclick="togglePasswordVisibility('current_password', this)" class="sf-prof-password-toggle">Show</button>
                                </div>
                            </div>

                            <div class="sf-prof-field-grid">
                                <div>
                                    <label for="password" class="sf-prof-label">New Password</label>
                                    <div class="sf-prof-password-wrap">
                                        <input type="password" id="password" name="password" required class="sf-prof-input sf-prof-password-input">
                                        <button type="button" onclick="togglePasswordVisibility('password', this)" class="sf-prof-password-toggle">Show</button>
                                    </div>
                                </div>

                                <div>
                                    <label for="password_confirmation" class="sf-prof-label">Confirm New Password</label>
                                    <div class="sf-prof-password-wrap">
                                        <input type="password" id="password_confirmation" name="password_confirmation" required class="sf-prof-input sf-prof-password-input">
                                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" class="sf-prof-password-toggle">Show</button>
                                    </div>
                                </div>
                            </div>

                            <div class="sf-prof-actions-right">
                                <button type="submit" class="sf-prof-btn sf-prof-btn-secondary">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function togglePasswordVisibility(inputId, button) {
    const input = document.getElementById(inputId);
    if (!input) return;

    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    button.textContent = isPassword ? 'Hide' : 'Show';
}

function previewImage(input) {
    const container = document.getElementById('preview-container');
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            container.innerHTML = '<img src="' + e.target.result + '" class="sf-prof-photo-preview-img">';
        };
        
        reader.readAsDataURL(file);
    }
}
</script>
@endsection

