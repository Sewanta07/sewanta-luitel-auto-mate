@extends('layouts.app')

@section('title', 'My Bookings - AutoMate')

@section('content')
@php($user = auth()->user())
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <a href="{{ route('dashboard.customer') }}" class="btn btn-outline">Dashboard</a>
                    <a href="{{ route('customer.profile') }}" class="btn btn-outline">My Profile</a>
                    <span class="user-info">Welcome, {{ $user?->name }}</span>
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
                <h2>My Bookings</h2>
                <p>Track pending, ongoing, and completed bookings. Download receipts.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">⏳</div>
                    <h3>Pending Bookings</h3>
                    <p>Bookings awaiting confirmation or start</p>
                    <ul class="feature-list">
                        <li>Reschedule or cancel options</li>
                        <li>View appointment details</li>
                        <li>Contact support</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Pending</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🔧</div>
                    <h3>Ongoing Service</h3>
                    <p>Services currently in progress</p>
                    <ul class="feature-list">
                        <li>Live status updates</li>
                        <li>Technician notes</li>
                        <li>Before/after images</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Ongoing</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">✅</div>
                    <h3>Completed Service</h3>
                    <p>Services finished and ready for pickup</p>
                    <ul class="feature-list">
                        <li>Service summary</li>
                        <li>Recommendations</li>
                        <li>Feedback and ratings</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Completed</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🧾</div>
                    <h3>Booking Receipt</h3>
                    <p>Download invoices and receipts</p>
                    <ul class="feature-list">
                        <li>PDF and email options</li>
                        <li>Tax and itemized details</li>
                        <li>Payment status</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Download Receipt</a>
                </div>
            </div>

            <div class="mt-8 bg-white rounded-xl p-4" style="border: 1px solid #eee;">
                <h3 style="margin-bottom: 12px;">Booking Payments</h3>
                @if(isset($bookings) && $bookings->count() > 0)
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Booking</th>
                                    <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Service</th>
                                    <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Total</th>
                                    <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Payment</th>
                                    <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td style="padding:8px; border-bottom:1px solid #f1f1f1;">{{ $booking->booking_code ?? ('#' . $booking->id) }}</td>
                                        <td style="padding:8px; border-bottom:1px solid #f1f1f1;">{{ $booking->service_type }}</td>
                                        <td style="padding:8px; border-bottom:1px solid #f1f1f1;">Rs. {{ number_format((float) ($booking->total_amount ?? 0), 2) }}</td>
                                        <td style="padding:8px; border-bottom:1px solid #f1f1f1;">{{ ucfirst($booking->payment_status ?? 'pending') }}</td>
                                        <td style="padding:8px; border-bottom:1px solid #f1f1f1;">
                                            @if((float) ($booking->total_amount ?? 0) > 0 && ($booking->payment_status ?? 'pending') !== 'paid')
                                                <form action="{{ route('payments.service.pay', $booking->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">Pay Now</button>
                                                </form>
                                            @else
                                                <span style="font-size: 12px; color: #666;">No action</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p style="color:#666;">No bookings found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

