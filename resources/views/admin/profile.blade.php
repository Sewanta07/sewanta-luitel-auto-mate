@extends('layouts.app')

@section('title', 'Admin Profile')

@section('content')
@section('content')
@include('components.admin-sidebar')

<div class="flex-1 p-4 sm:p-6 lg:p-8 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        {{-- Page Header --}}
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">My Profile</h2>
                <p class="mt-1 text-sm text-gray-500">Manage your profile information and credentials</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-50 p-4 border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 p-4 border border-red-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="space-y-6">
            {{-- Profile Information --}}
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <h3 class="text-base font-semibold leading-7 text-gray-900">Profile Information</h3>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Update your account's profile information and email address.</p>
                            </div>

                            <div class="col-span-full">
                                <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                                <div class="mt-2 flex items-center gap-x-3">
                                    <div class="h-12 w-12 rounded-full overflow-hidden bg-gray-100 ring-1 ring-gray-300">
                                         @if($admin->profile_image)
                                            <img src="{{ asset('storage/' . $admin->profile_image) }}" alt="Profile" class="h-full w-full object-cover" id="profile-preview">
                                        @else
                                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <input type="file" name="profile_image" id="profile_image" class="hidden" accept="image/*" onchange="previewImage(this)">
                                    <button type="button" onclick="document.getElementById('profile_image').click()" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Change</button>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#ff5a1f] sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                <div class="mt-2">
                                    <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#ff5a1f] sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                                <div class="mt-2">
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $admin->phone) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#ff5a1f] sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            
                             <div class="sm:col-span-3">
                                <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                                <div class="mt-2">
                                    <input type="text" disabled value="{{ ucfirst($admin->status) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-500 bg-gray-50 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="current_address" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                                <div class="mt-2">
                                    <textarea name="current_address" id="current_address" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#ff5a1f] sm:text-sm sm:leading-6">{{ old('current_address', $admin->current_address) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                        <button type="submit" class="rounded-md bg-[#ff5a1f] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#e64b15] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#ff5a1f]">Save</button>
                    </div>
                </form>
            </div>

            {{-- Change Password --}}
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <form method="POST" action="{{ route('admin.profile.password') }}">
                    @csrf
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <h3 class="text-base font-semibold leading-7 text-gray-900">Change Password</h3>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
                            </div>

                            <div class="col-span-full">
                                <label for="current_password" class="block text-sm font-medium leading-6 text-gray-900">Current Password</label>
                                <div class="mt-2">
                                    <input type="password" name="current_password" id="current_password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#ff5a1f] sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">New Password</label>
                                <div class="mt-2">
                                    <input type="password" name="password" id="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#ff5a1f] sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                                <div class="mt-2">
                                    <input type="password" name="password_confirmation" id="password_confirmation" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#ff5a1f] sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                        <button type="submit" class="rounded-md bg-[#ff5a1f] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#e64b15] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#ff5a1f]">Update Password</button>
                    </div>
                </form>
            </div>
            
            {{-- Account Information (Read Only) --}}
             <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <div class="px-4 py-6 sm:p-8">
                     <h3 class="text-base font-semibold leading-7 text-gray-900 mb-6">Account Details</h3>
                     <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">User ID</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $admin->id }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Email Verified</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($admin->email_verified_at)
                                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Verified on {{ $admin->email_verified_at->format('M d, Y') }}</span>
                                @else
                                    <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Pending</span>
                                @endif
                            </dd>
                        </div>
                         <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Account Created</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $admin->created_at->format('F d, Y') }}</dd>
                        </div>
                         <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $admin->updated_at->format('F d, Y h:i A') }}</dd>
                        </div>
                     </dl>
                </div>
             </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('profile-preview');
            // Check if preview is an img tag, otherwise create one
            if (preview.tagName !== 'IMG') {
                let img = document.createElement('img');
                img.id = 'profile-preview';
                img.className = 'h-full w-full object-cover';
                preview.parentNode.innerHTML = '';
                preview.parentNode.appendChild(img);
                preview = img;
            }
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
@endsection
