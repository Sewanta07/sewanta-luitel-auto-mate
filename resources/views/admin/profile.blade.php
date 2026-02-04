@extends('layouts.app')

@section('title', 'My Profile - AutoMate')

@section('content')
@include('components.admin-sidebar')

<!-- Main Content Area -->
<div class="flex flex-col min-h-screen">
    <!-- Full-width wrapper with proper sidebar offset -->
    <div class="flex-1 ml-0 md:ml-80 bg-gray-50 min-h-screen">
        <div class="w-full py-8 px-6 sm:px-10 lg:px-16">
            <main class="max-w-4xl mx-auto">
        {{-- Page Header --}}
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-gray-900">My Profile</h1>
            <p class="mt-3 text-lg text-gray-600">Manage your profile information and credentials.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Profile Card & Credentials -->
            <div class="space-y-6">
                 <!-- Account Info Card -->
                 <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="inline-block relative">
                            <div class="w-12 h-12 rounded-full border-4 border-white shadow-lg overflow-hidden mx-auto mb-4 bg-gray-100 flex items-center justify-center">
                                @if($admin->profile_image)
                                    <img src="{{ asset('storage/' . $admin->profile_image) }}" alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <span class="text-xl font-bold text-[#ff5a1f]">{{ strtoupper(substr($admin->name, 0, 1)) }}</span>
                                @endif
                            </div>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $admin->name }}</h2>
                        <p class="text-sm text-gray-500 mb-2">{{ $admin->email }}</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($admin->role ?? 'Administrator') }}
                        </span>
                    </div>
                    <div class="border-t border-gray-100 p-6 bg-gray-50">
                        <h3 class="text-sm font-medium text-gray-900 mb-4">Account Details</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Admin ID</span>
                                <span class="font-mono font-medium text-gray-900">#{{ $admin->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ ucfirst($admin->status ?? 'active') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Email Verified</span>
                                @if($admin->email_verified_at)
                                    <span class="text-green-600 font-medium">Verified</span>
                                @else
                                    <span class="text-yellow-600 font-medium">Not Verified</span>
                                @endif
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Joined</span>
                                <span class="text-gray-900 font-medium">{{ $admin->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Change Password Card --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="p-2 bg-purple-50 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Security</h3>
                    </div>
                    <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Current Password</label>
                            <input type="password" name="current_password" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">New Password</label>
                            <input type="password" name="password" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Confirm New Password</label>
                            <input type="password" name="password_confirmation" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                        </div>
                        <button type="submit" class="w-full py-3 rounded-xl bg-gray-900 text-white font-bold hover:bg-gray-800 transition shadow-lg shadow-gray-200">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Profile Edit Forms (lg:col-span-2) -->
            <div class="lg:col-span-2 space-y-6">
                {{-- Profile Information Form --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Profile Information</h3>
                    </div>
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        {{-- Profile Picture --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Profile Picture</label>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                <div class="w-10 h-10 rounded-full overflow-hidden border-4 border-orange-100 bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    @if($admin->profile_image)
                                        <img src="{{ asset('storage/' . $admin->profile_image) }}" alt="Profile" class="w-10 h-10 object-cover rounded-full" id="profile-preview">
                                    @else
                                        <span class="text-lg font-bold text-gray-300">{{ strtoupper(substr($admin->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <label for="profile_image_input" class="inline-flex items-center px-4 py-2 rounded-xl bg-[#ff5a1f] text-white font-semibold cursor-pointer hover:bg-[#e64b15] transition">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Change Photo
                                        <input type="file" id="profile_image_input" name="profile_image" class="hidden" accept="image/*" onchange="previewProfileImage(this)">
                                    </label>
                                    <p class="mt-2 text-xs text-gray-500 italic">JPG, PNG, GIF. Max 2MB.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Full Name --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $admin->name) }}" required class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#ff5a1f] focus:ring-2 focus:ring-[#ff5a1f] focus:ring-opacity-10 transition duration-200">
                        </div>

                        {{-- Email Address --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $admin->email) }}" required class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#ff5a1f] focus:ring-2 focus:ring-[#ff5a1f] focus:ring-opacity-10 transition duration-200">
                        </div>

                        {{-- Phone Number --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone', $admin->phone) }}" class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#ff5a1f] focus:ring-2 focus:ring-[#ff5a1f] focus:ring-opacity-10 transition duration-200">
                        </div>

                        {{-- Address --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Address</label>
                            <textarea name="current_address" rows="3" class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#ff5a1f] focus:ring-2 focus:ring-[#ff5a1f] focus:ring-opacity-10 transition duration-200">{{ old('current_address', $admin->current_address) }}</textarea>
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="flex-1 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition shadow-lg shadow-orange-200">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
            </div>
        </div>
    </div>

<script>
function previewProfileImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('profile-preview');
            if (!preview) {
                const container = input.closest('div')?.previousElementSibling;
                if (container) {
                    container.innerHTML = '<img id="profile-preview" class="w-10 h-10 object-cover rounded-full" alt="Profile">';
                    preview = document.getElementById('profile-preview');
                }
            }
            if (preview) {
                preview.src = e.target.result;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
