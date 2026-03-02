@extends('layouts.admin')

@section('title', 'User Profile')

@section('content')
<div class="ad-upro-page">
    <div class="ad-upro-container">
        {{-- Page Header --}}
        <div class="ad-upro-head">
            <div class="ad-upro-head-main">
                 <div class="ad-upro-breadcrumb">
                    <a href="{{ route('admin.users') }}" class="ad-upro-breadcrumb-link">Users</a>
                    <svg class="ad-upro-breadcrumb-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    <span>Profile</span>
                </div>
                <h2 class="ad-upro-title">{{ $user->name }}</h2>
                <div class="ad-upro-meta-row">
                    <div class="ad-upro-meta-item">
                        <svg class="ad-upro-meta-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        {{ ucfirst($user->role) }}
                    </div>
                    <div class="ad-upro-meta-item">
                         @if($user->status === 'active')
                            <span class="ad-upro-badge ad-upro-badge-active">Active</span>
                        @else
                             <span class="ad-upro-badge ad-upro-badge-inactive">Inactive</span>
                        @endif
                    </div>
                </div>
            </div>
             <div class="ad-upro-back-wrap">
                <a href="{{ url()->previous() }}" class="ad-upro-back-btn">
                    Back
                </a>
            </div>
        </div>

        <div class="ad-upro-panel">
            <div class="ad-upro-panel-head">
                <div class="ad-upro-user-row">
                    <div class="ad-upro-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="ad-upro-user-meta">
                        <h3 class="ad-upro-user-name">{{ $user->name }}</h3>
                        <p class="ad-upro-user-email">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
            
            <div class="ad-upro-panel-body">
                 <dl class="ad-upro-grid">
                    <div>
                        <dt class="ad-upro-dt">Full Name</dt>
                        <dd class="ad-upro-dd">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="ad-upro-dt">Email Address</dt>
                        <dd class="ad-upro-dd">{{ $user->email }}</dd>
                    </div>

                    @if($user->role === 'staff')
                        <div>
                            <dt class="ad-upro-dt">Position</dt>
                            <dd class="ad-upro-dd">{{ $user->staffDetail->position ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="ad-upro-dt">Phone</dt>
                            <dd class="ad-upro-dd">{{ $user->staffDetail->phone ?? 'Not provided' }}</dd>
                        </div>
                         <div>
                            <dt class="ad-upro-dt">Experience</dt>
                            <dd class="ad-upro-dd">{{ $user->staffDetail->experience ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="ad-upro-dt">Documents</dt>
                            <dd class="ad-upro-dd">{{ $user->staffDetail->documents ?? 'Not provided' }}</dd>
                        </div>
                    @endif

                    <div>
                        <dt class="ad-upro-dt">Member Since</dt>
                        <dd class="ad-upro-dd">{{ $user->created_at?->format('M d, Y') }}</dd>
                    </div>
                    
                    <div class="ad-upro-span-full">
                        <dt class="ad-upro-dt">Address</dt>
                        <dd class="ad-upro-dd">{{ $user->address ?? 'Not provided' }}</dd>
                    </div>
                 </dl>
            </div>
        </div>
    </div>
</div>
@endsection

