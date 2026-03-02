@extends('layouts.admin')

@section('title', 'Contact Messages - Admin')

@section('content')
<div class="ad-cmsgi-page">
    <main class="ad-cmsgi-main">
        <div class="ad-cmsgi-head">
            <div>
                <h1 class="ad-cmsgi-title">Contact Messages</h1>
                <p class="ad-cmsgi-subtitle">Manage customer inquiries and feedback</p>
            </div>
            <div>
                @if($newCount > 0)
                    <span class="ad-cmsgi-pill">{{ $newCount }} New</span>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="ad-cmsgi-flash">
                <div class="ad-cmsgi-flash-row">
                    <svg class="ad-cmsgi-flash-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="ad-cmsgi-flash-text">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="ad-cmsgi-panel">
            <div class="ad-cmsgi-table-wrap">
                <table class="ad-cmsgi-table">
                    <thead class="ad-cmsgi-table-head">
                        <tr>
                            <th scope="col" class="ad-cmsgi-th">Status</th>
                            <th scope="col" class="ad-cmsgi-th">Name</th>
                            <th scope="col" class="ad-cmsgi-th">Email</th>
                            <th scope="col" class="ad-cmsgi-th">Subject</th>
                            <th scope="col" class="ad-cmsgi-th">Date</th>
                            <th scope="col" class="ad-cmsgi-th ad-cmsgi-th-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr class="ad-cmsgi-row {{ $message->status === 'new' ? 'ad-cmsgi-row-new' : '' }}">
                                <td class="ad-cmsgi-td ad-cmsgi-nowrap">
                                    @if($message->status === 'new')
                                        <span class="ad-cmsgi-badge ad-cmsgi-badge-new">New</span>
                                    @elseif($message->status === 'read')
                                        <span class="ad-cmsgi-badge ad-cmsgi-badge-read">Read</span>
                                    @else
                                        <span class="ad-cmsgi-badge ad-cmsgi-badge-replied">Replied</span>
                                    @endif
                                </td>
                                <td class="ad-cmsgi-td ad-cmsgi-nowrap">
                                    <p class="ad-cmsgi-name">{{ $message->name }}</p>
                                </td>
                                <td class="ad-cmsgi-td ad-cmsgi-nowrap">
                                    <p class="ad-cmsgi-email">{{ $message->email }}</p>
                                </td>
                                <td class="ad-cmsgi-td">
                                    <p class="ad-cmsgi-subject">{{ $message->subject }}</p>
                                </td>
                                <td class="ad-cmsgi-td ad-cmsgi-nowrap">
                                    <p class="ad-cmsgi-date">{{ $message->created_at->format('M d, Y') }}</p>
                                </td>
                                <td class="ad-cmsgi-td ad-cmsgi-nowrap ad-cmsgi-td-right">
                                    <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="ad-cmsgi-link">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr class="ad-cmsgi-row">
                                <td colspan="6" class="ad-cmsgi-empty">
                                    <svg class="ad-cmsgi-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <p class="ad-cmsgi-empty-title">No messages yet</p>
                                    <p class="ad-cmsgi-empty-note">Contact form submissions will appear here</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($messages->hasPages())
                <div class="ad-cmsgi-pagination">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
@endsection
