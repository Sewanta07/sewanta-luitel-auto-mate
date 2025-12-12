@extends('layouts.app')

@section('title', 'My Profile - AutoMate')

@section('content')
@php($staff = $user ?? auth()->user())
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <a href="{{ route('dashboard.staff') }}" class="btn btn-outline">Dashboard</a>
                    <span class="user-info">Welcome, {{ $staff?->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-outline">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-content">
        <div class="container">
            <div class="dashboard-header">
                <h2>My Profile</h2>
                <p>Manage your profile information and credentials</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Profile Information Section -->
            <div class="dashboard-section">
                <h3>Profile Information</h3>
                
                <form method="POST" action="{{ route('staff.profile.update') }}" enctype="multipart/form-data" class="profile-form">
                    @csrf
                    
                    <div class="profile-header">
                        <div class="profile-image-section">
                            <div class="profile-image-preview">
                                @if($staff->profile_image)
                                    <img src="{{ asset('storage/' . $staff->profile_image) }}" alt="Profile Image" id="profile-preview">
                                @else
                                    <div class="profile-placeholder" id="profile-preview">
                                        <span>{{ strtoupper(substr($staff->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="profile_image">Profile Picture</label>
                                <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(this)" class="form-control">
                                <small class="text-muted">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF</small>
                                @error('profile_image')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $staff->name) }}" required class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email', $staff->email) }}" required class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $staff->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="e.g., +1234567890">
                            @error('phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" id="position" name="position" value="{{ old('position', $staff->position) }}" class="form-control @error('position') is-invalid @enderror" placeholder="e.g., Senior Mechanic">
                            @error('position')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="experience">Experience</label>
                            <input type="text" id="experience" name="experience" value="{{ old('experience', $staff->experience) }}" class="form-control @error('experience') is-invalid @enderror" placeholder="e.g., 5 years">
                            @error('experience')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Account Status</label>
                            <input type="text" value="{{ ucfirst($staff->status) }}" class="form-control" disabled>
                            <small class="text-muted">Status cannot be changed from profile</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="current_address">Current Address</label>
                        <textarea id="current_address" name="current_address" rows="3" class="form-control @error('current_address') is-invalid @enderror" placeholder="Enter your full address">{{ old('current_address', $staff->current_address) }}</textarea>
                        @error('current_address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>

            <!-- Password Change Section -->
            <div class="dashboard-section">
                <h3>Change Password</h3>
                
                <form method="POST" action="{{ route('staff.profile.password') }}" class="password-form">
                    @csrf
                    
                    <div class="form-group">
                        <label for="current_password">Current Password <span class="required">*</span></label>
                        <div class="password-input-wrapper">
                            <input type="password" id="current_password" name="current_password" required class="form-control @error('current_password') is-invalid @enderror">
                            <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
                                <span class="password-icon-show">👁️</span>
                                <span class="password-icon-hide" style="display: none;">🙈</span>
                            </button>
                        </div>
                        @error('current_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">New Password <span class="required">*</span></label>
                            <div class="password-input-wrapper">
                                <input type="password" id="password" name="password" required class="form-control @error('password') is-invalid @enderror">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <span class="password-icon-show">👁️</span>
                                    <span class="password-icon-hide" style="display: none;">🙈</span>
                                </button>
                            </div>
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password <span class="required">*</span></label>
                            <div class="password-input-wrapper">
                                <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control">
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                    <span class="password-icon-show">👁️</span>
                                    <span class="password-icon-hide" style="display: none;">🙈</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>

            <!-- Account Credentials Section -->
            <div class="dashboard-section">
                <h3>Account Credentials</h3>
                <div class="credentials-info">
                    <div class="info-row">
                        <span class="info-label">Staff ID:</span>
                        <span class="info-value">{{ $staff->id }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $staff->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Role:</span>
                        <span class="info-value badge success">Staff Member</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Position:</span>
                        <span class="info-value">{{ $staff->position ?? 'Not specified' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Experience:</span>
                        <span class="info-value">{{ $staff->experience ?? 'Not specified' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Account Created:</span>
                        <span class="info-value">{{ $staff->created_at->format('F d, Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Last Updated:</span>
                        <span class="info-value">{{ $staff->updated_at->format('F d, Y h:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-header {
    margin-bottom: 2rem;
}

.profile-image-section {
    display: flex;
    align-items: center;
    gap: 2rem;
    padding: 1.5rem;
    background: var(--card-bg);
    border-radius: var(--radius);
    border: 1px solid var(--border-color);
}

.profile-image-preview {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.profile-image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-color), #2563eb);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    font-weight: bold;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .profile-image-section {
        flex-direction: column;
        text-align: center;
    }
}

.form-actions {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
}

.required {
    color: var(--danger-color);
}

.credentials-info {
    background: var(--card-bg);
    border-radius: var(--radius);
    padding: 1.5rem;
    border: 1px solid var(--border-color);
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--border-color);
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 500;
    color: var(--text-secondary);
}

.info-value {
    color: var(--text-primary);
    font-weight: 500;
}

.password-form {
    margin-top: 1rem;
}
</style>

<script>
function previewImage(input) {
    const preview = document.getElementById('profile-preview');
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Profile Image';
                img.id = 'profile-preview';
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                preview.parentNode.replaceChild(img, preview);
            }
        };
        
        reader.readAsDataURL(file);
    }
}

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const wrapper = input.closest('.password-input-wrapper');
    const button = wrapper.querySelector('.password-toggle');
    const showIcon = button.querySelector('.password-icon-show');
    const hideIcon = button.querySelector('.password-icon-hide');
    
    if (input.type === 'password') {
        input.type = 'text';
        showIcon.style.display = 'none';
        hideIcon.style.display = 'inline-block';
    } else {
        input.type = 'password';
        showIcon.style.display = 'inline-block';
        hideIcon.style.display = 'none';
    }
}
</script>
@endsection

