@extends('layouts.admin')

@section('title', 'Transactions - AutoMate')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Transactions</h1>
            <p class="text-gray-600">System income, failed payments, and payout transactions</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-4 mb-8">
            <form method="GET" action="{{ route('admin.transactions') }}" class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                    <input type="date" name="date_from" value="{{ $dateFrom ?? request('date_from') }}" class="rounded-lg border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                    <input type="date" name="date_to" value="{{ $dateTo ?? request('date_to') }}" class="rounded-lg border-gray-300" />
                </div>
                <button type="submit" class="px-5 py-2 bg-[#ff5a1f] text-white rounded-lg font-semibold hover:opacity-90">Apply</button>
                <a href="{{ route('admin.transactions') }}" class="px-5 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200">Reset</a>
                <a href="{{ route('admin.transactions.export', ['date_from' => $dateFrom, 'date_to' => $dateTo]) }}" class="px-5 py-2 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800">Export CSV</a>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Total Income</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">Rs. {{ number_format((float) ($totalIncome ?? 0), 2) }}</h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Failed Transactions</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format(($failedPayments ?? collect())->count()) }}</h3>
                <p class="text-xs text-red-600 mt-2">Amount: Rs. {{ number_format((float) ($totalFailedAmount ?? 0), 2) }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Paid Out</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">Rs. {{ number_format((float) ($totalPayoutPaid ?? 0), 2) }}</h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Pending Payout</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">Rs. {{ number_format((float) ($pendingPayoutAmount ?? 0), 2) }}</h3>
                <p class="text-xs text-gray-500 mt-2">Pending owner earnings: Rs. {{ number_format((float) ($ownerPendingEarnings ?? 0), 2) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Income Transactions</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-3 pr-4">Order</th>
                                <th class="py-3 pr-4">Type</th>
                                <th class="py-3 pr-4">Customer</th>
                                <th class="py-3 pr-4">Amount</th>
                                <th class="py-3 pr-4">Paid At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($incomeTransactions as $payment)
                                <tr class="border-b last:border-0">
                                    <td class="py-3 pr-4 text-gray-800 font-semibold">{{ $payment->order_id }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ ucfirst(str_replace('_', ' ', $payment->type)) }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ $payment->user->name ?? 'N/A' }}</td>
                                    <td class="py-3 pr-4 text-green-700 font-semibold">Rs. {{ number_format((float) $payment->amount, 2) }}</td>
                                    <td class="py-3 pr-4 text-gray-500">{{ optional($payment->paid_at ?? $payment->updated_at)->format('M d, Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">No paid transactions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Failed Transactions</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-3 pr-4">Order</th>
                                <th class="py-3 pr-4">Type</th>
                                <th class="py-3 pr-4">Customer</th>
                                <th class="py-3 pr-4">Amount</th>
                                <th class="py-3 pr-4">Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($failedPayments as $payment)
                                <tr class="border-b last:border-0">
                                    <td class="py-3 pr-4 text-gray-800 font-semibold">{{ $payment->order_id }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ ucfirst(str_replace('_', ' ', $payment->type)) }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ $payment->user->name ?? 'N/A' }}</td>
                                    <td class="py-3 pr-4 text-red-700 font-semibold">Rs. {{ number_format((float) $payment->amount, 2) }}</td>
                                    <td class="py-3 pr-4 text-gray-500">{{ optional($payment->updated_at)->format('M d, Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">No failed transactions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Payout Transactions</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="py-3 pr-4">Owner</th>
                            <th class="py-3 pr-4">Amount</th>
                            <th class="py-3 pr-4">Status</th>
                            <th class="py-3 pr-4">Requested</th>
                            <th class="py-3 pr-4">Processed</th>
                            <th class="py-3 pr-4">Processed By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payoutTransactions as $payout)
                            <tr class="border-b last:border-0">
                                <td class="py-3 pr-4 text-gray-800 font-semibold">{{ $payout->owner->name ?? 'N/A' }}</td>
                                <td class="py-3 pr-4 text-gray-700">Rs. {{ number_format((float) $payout->amount, 2) }}</td>
                                <td class="py-3 pr-4">
                                    @php
                                        $status = strtolower((string) $payout->status);
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        {{ $status === 'paid' ? 'bg-green-100 text-green-700' : ($status === 'rejected' ? 'bg-red-100 text-red-700' : ($status === 'approved' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700')) }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="py-3 pr-4 text-gray-500">{{ optional($payout->requested_at ?? $payout->created_at)->format('M d, Y h:i A') }}</td>
                                <td class="py-3 pr-4 text-gray-500">{{ optional($payout->processed_at)->format('M d, Y h:i A') ?? '-' }}</td>
                                <td class="py-3 pr-4 text-gray-700">{{ data_get($payout, 'processor.name', '-') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500">No payout transactions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
