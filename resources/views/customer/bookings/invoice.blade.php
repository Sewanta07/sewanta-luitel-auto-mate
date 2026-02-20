@extends('layouts.app')

@section('title', 'Service Invoice - AutoMate')

@section('content')
@include('customer.navbar')

<div class="min-h-screen bg-gray-50 pb-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 sm:p-10">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-black text-gray-900">Service Invoice</h1>
                    <p class="text-gray-500 mt-1">Booking {{ $booking->booking_code }}</p>
                </div>
                <span class="px-3 py-1 text-xs font-black uppercase tracking-widest rounded-full bg-green-50 text-green-600">Completed</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Vehicle</p>
                    <p class="text-lg font-bold text-gray-900">{{ $booking->vehicle_model }}</p>
                    <p class="text-sm text-gray-500">{{ $booking->vehicle_number }} • {{ $booking->vehicle_type }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Service</p>
                    <p class="text-lg font-bold text-gray-900">{{ $booking->service_type }}</p>
                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }} • {{ $booking->preferred_time_slot }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Priority</p>
                    <p class="text-sm font-bold text-gray-900">{{ $booking->service_priority }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Location</p>
                    <p class="text-sm font-bold text-gray-900">{{ $booking->service_location_type }}</p>
                </div>
            </div>

            @php($partsTotal = $booking->parts->sum('pivot.total_cost'))

            <div class="mt-8 border-t border-gray-100 pt-6">
                <h3 class="text-sm font-bold text-gray-700 mb-4">Parts Used</h3>
                <div class="border border-gray-100 rounded-xl overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 font-semibold border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-3">Part</th>
                                <th class="px-4 py-3 text-center">Qty</th>
                                <th class="px-4 py-3 text-right">Unit Price</th>
                                <th class="px-4 py-3 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($booking->parts as $part)
                                <tr>
                                    <td class="px-4 py-3 text-gray-900">{{ $part->part_name }}</td>
                                    <td class="px-4 py-3 text-center text-gray-500">{{ $part->pivot->quantity }}</td>
                                    <td class="px-4 py-3 text-right text-gray-500">Rs. {{ number_format($part->pivot->unit_price, 2) }}</td>
                                    <td class="px-4 py-3 text-right text-gray-900 font-medium">Rs. {{ number_format($part->pivot->total_cost, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">No parts recorded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-gray-50 font-bold text-gray-900">
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-right">Parts Total</td>
                                <td class="px-4 py-3 text-right text-[#ff5a1f]">Rs. {{ number_format($partsTotal, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-100 pt-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-bold text-gray-500">Estimated Cost</p>
                    <p class="text-xl font-black text-gray-900">{{ $booking->estimated_cost ? 'Rs. ' . number_format($booking->estimated_cost, 2) : 'TBD' }}</p>
                </div>
            </div>

            @php($computedAmount = ($booking->service_cost ?? 0) + ($booking->spare_parts_cost ?? 0) + $partsTotal)
            @php($payableAmount = ($booking->total_amount ?? 0) > 0 ? $booking->total_amount : $computedAmount)

            <div class="mt-8 border-t border-gray-100 pt-6">
                <h3 class="text-sm font-bold text-gray-700 mb-4">Payment Summary</h3>
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-gray-500">Total Payable</p>
                        <p class="text-xl font-black text-[#ff5a1f]">Rs. {{ number_format($payableAmount, 2) }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-gray-500">Service Cost</p>
                        <p class="text-sm font-bold text-gray-900">Rs. {{ number_format($booking->service_cost ?? 0, 2) }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-gray-500">Spare Parts Cost</p>
                        <p class="text-sm font-bold text-gray-900">Rs. {{ number_format($booking->spare_parts_cost ?? 0, 2) }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-gray-500">Parts Total</p>
                        <p class="text-sm font-bold text-gray-900">Rs. {{ number_format($partsTotal, 2) }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-gray-500">Payment Status</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ ($booking->payment_status ?? 'pending') === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($booking->payment_status ?? 'pending') }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-gray-500">Payment Method</p>
                        <p class="text-sm font-bold text-gray-900">eSewa</p>
                    </div>

                    @if(($booking->payment_status ?? 'pending') !== 'paid')
                        @if($payableAmount > 0)
                            <form action="{{ route('payments.service.pay', $booking->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full mt-2 px-6 py-3 bg-[#ff5a1f] text-white font-black rounded-xl hover:bg-[#e44d18] transition">
                                    Pay with eSewa
                                </button>
                            </form>
                        @else
                            <p class="text-sm text-gray-500">Payment will be available once the service amount is set.</p>
                        @endif
                    @endif
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <a href="{{ route('bookings.index') }}" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl text-center hover:bg-gray-200">Back to Bookings</a>
                <button class="flex-1 px-6 py-3 bg-[#ff5a1f] text-white font-black rounded-xl hover:bg-[#e44d18]">Download PDF</button>
            </div>
        </div>
    </div>
</div>
@endsection
