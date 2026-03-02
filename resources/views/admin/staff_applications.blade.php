@extends('layouts.admin')

@section('title', 'Staff Applications')

@section('content')
<main class="ad-staffapps-main">
            <div class="ad-staffapps-head">
                <div>
                    <h1 class="ad-staffapps-title">Staff Applications</h1>
                    <p class="ad-staffapps-subtitle">Review and manage pending staff requests.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="ad-staffapps-alert ad-staffapps-alert-success">
                    <svg class="ad-staffapps-alert-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="ad-staffapps-alert-text">{{ session('success') }}</span>
                </div>
            @endif

            <div class="ad-staffapps-card">
                <div class="ad-staffapps-card-head">
                    <h2 class="ad-staffapps-card-title">Pending Requests</h2>
                </div>

                @if($pendingStaff->isEmpty())
                    <div class="ad-staffapps-empty">
                        <div class="ad-staffapps-empty-icon-wrap">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        No pending staff applications at this time.
                    </div>
                @else
                    <div class="ad-staffapps-table-wrap">
                        <table class="ad-staffapps-table">
                            <thead>
                                <tr>
                                    <th scope="col">Applicant</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Applied On</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Position/Role</th>
                                    <th scope="col" class="ad-align-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingStaff as $staff)
                                    <tr>
                                        <td>
                                            <div class="ad-staffapps-name-cell">
                                                <div class="ad-staffapps-avatar">
                                                    {{ substr($staff->name, 0, 1) }}
                                                </div>
                                                <span class="ad-staffapps-name">{{ $staff->name }}</span>
                                            </div>
                                        </td>
                                        <td class="ad-staffapps-muted">{{ $staff->email }}</td>
                                        <td class="ad-staffapps-muted">{{ $staff->created_at?->format('M d, Y') }}</td>
                                        <td>
                                            <span class="ad-staffapps-status-badge">
                                                {{ ucfirst($staff->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.staff-applications.updateRole', $staff) }}" method="POST" class="ad-staffapps-role-form">
                                                @csrf
                                                <input type="text" name="level" class="ad-staffapps-role-input" placeholder="e.g. Senior Mech" value="{{ $staff->position ?? '' }}">
                                                <button type="submit" class="ad-staffapps-action-link ad-staffapps-action-save">Save</button>
                                            </form>
                                        </td>
                                        <td class="ad-staffapps-actions-cell">
                                            <div class="ad-staffapps-actions-wrap">
                                                <form action="{{ route('admin.staff-applications.approve', $staff) }}" method="POST" class="ad-staffapps-inline-form">
                                                    @csrf
                                                    <button type="submit" class="ad-staffapps-action-link ad-staffapps-action-approve">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.staff-applications.reject', $staff) }}" method="POST" class="ad-staffapps-inline-form">
                                                    @csrf
                                                    <button type="submit" class="ad-staffapps-action-link ad-staffapps-action-reject">Reject</button>
                                                </form>
                                                <form action="{{ route('admin.staff-applications.destroy', $staff) }}" method="POST" class="ad-staffapps-inline-form" onsubmit="return confirm('Delete this application permanently?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ad-staffapps-delete-btn" title="Delete">
                                                        <svg class="ad-staffapps-delete-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
</main>
@endsection
