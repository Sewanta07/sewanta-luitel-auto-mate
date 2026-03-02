@extends('layouts.admin')

@section('title', 'View Message - Admin')

@section('content')
<div class="ad-cmsgs-page">
    <main class="ad-cmsgs-main">
        <div class="ad-cmsgs-head">
            <div class="ad-cmsgs-crumb">
                <a href="{{ route('admin.contact-messages.index') }}" class="ad-cmsgs-crumb-link">Contact Messages</a>
                <svg class="ad-cmsgs-crumb-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                <span>Message Details</span>
            </div>
            <h1 class="ad-cmsgs-title">{{ $message->subject }}</h1>
        </div>

        @if(session('success'))
            <div class="ad-cmsgs-flash">
                <div class="ad-cmsgs-flash-row">
                    <svg class="ad-cmsgs-flash-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="ad-cmsgs-flash-text">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="ad-cmsgs-card">
            <div class="ad-cmsgs-card-head">
                <div class="ad-cmsgs-row">
                    <div class="ad-cmsgs-author">
                        <div class="ad-cmsgs-avatar">{{ strtoupper(substr($message->name, 0, 1)) }}</div>
                        <div>
                            <h3 class="ad-cmsgs-author-name">{{ $message->name }}</h3>
                            <p class="ad-cmsgs-author-email">{{ $message->email }}</p>
                        </div>
                    </div>
                    <div class="ad-cmsgs-meta">
                        @if($message->status === 'new')
                            <span class="ad-cmsgs-badge ad-cmsgs-badge-new">New</span>
                        @elseif($message->status === 'read')
                            <span class="ad-cmsgs-badge ad-cmsgs-badge-read">Read</span>
                        @else
                            <span class="ad-cmsgs-badge ad-cmsgs-badge-replied">Replied</span>
                        @endif
                        <p class="ad-cmsgs-date">{{ $message->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>

            <div class="ad-cmsgs-body">
                <div class="ad-cmsgs-section">
                    <h4 class="ad-cmsgs-label">Subject</h4>
                    <p class="ad-cmsgs-subject">{{ $message->subject }}</p>
                </div>
                <div class="ad-cmsgs-section">
                    <h4 class="ad-cmsgs-label">Message</h4>
                    <p class="ad-cmsgs-message">{{ $message->message }}</p>
                </div>
            </div>
        </div>

        <div class="ad-cmsgs-actions">
            <h3 class="ad-cmsgs-actions-title">Actions</h3>
            <div class="ad-cmsgs-actions-row">
                <form action="{{ route('admin.contact-messages.updateStatus', $message->id) }}" method="POST" class="ad-cmsgs-inline-form">
                    @csrf
                    <select name="status" onchange="this.form.submit()" class="ad-cmsgs-select">
                        <option value="new" {{ $message->status === 'new' ? 'selected' : '' }}>Mark as New</option>
                        <option value="read" {{ $message->status === 'read' ? 'selected' : '' }}>Mark as Read</option>
                        <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>Mark as Replied</option>
                    </select>
                </form>

                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="ad-cmsgs-btn ad-cmsgs-btn-primary">
                    <svg class="ad-cmsgs-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Reply via Email
                </a>

                <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" class="ad-cmsgs-inline-form" onsubmit="return confirm('Are you sure you want to delete this message?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ad-cmsgs-btn ad-cmsgs-btn-danger">
                        <svg class="ad-cmsgs-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Message
                    </button>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection
