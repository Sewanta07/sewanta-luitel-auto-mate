<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Earning;
use App\Models\Payment;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        [$dateFrom, $dateTo] = $this->resolveDateRange($request);

        $incomeBase = Payment::query()->where('status', 'paid');
        $failedBase = Payment::query()->where('status', 'failed');
        $payoutBase = WithdrawalRequest::query();

        $this->applyDateRange($incomeBase, 'COALESCE(paid_at, updated_at, created_at)', $dateFrom, $dateTo);
        $this->applyDateRange($failedBase, 'COALESCE(updated_at, created_at)', $dateFrom, $dateTo);
        $this->applyDateRange($payoutBase, 'COALESCE(processed_at, requested_at, created_at)', $dateFrom, $dateTo);

        $totalIncome = (float) (clone $incomeBase)
            ->sum('amount');

        $failedPayments = (clone $failedBase)
            ->with('user:id,name')
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->limit(20)
            ->get();

        $totalFailedAmount = (float) (clone $failedBase)
            ->sum('amount');

        $incomeTransactions = (clone $incomeBase)
            ->with('user:id,name')
            ->orderByDesc('paid_at')
            ->orderByDesc('id')
            ->limit(20)
            ->get();

        $payoutTransactions = (clone $payoutBase)
            ->with(['owner:id,name', 'processor:id,name'])
            ->orderByDesc('processed_at')
            ->orderByDesc('requested_at')
            ->orderByDesc('id')
            ->limit(20)
            ->get();

        $totalPayoutPaid = (float) (clone $payoutBase)
            ->where('status', 'paid')
            ->sum('amount');

        $pendingPayoutAmount = (float) (clone $payoutBase)
            ->where('status', 'pending')
            ->sum('amount');

        $ownerPendingEarnings = (float) Earning::query()
            ->where('payout_status', 'pending')
            ->sum('owner_amount');

        return view('admin.transactions.index', compact(
            'totalIncome',
            'failedPayments',
            'totalFailedAmount',
            'incomeTransactions',
            'payoutTransactions',
            'totalPayoutPaid',
            'pendingPayoutAmount',
            'ownerPendingEarnings',
            'dateFrom',
            'dateTo'
        ));
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        [$dateFrom, $dateTo] = $this->resolveDateRange($request);

        $income = Payment::query()
            ->with('user:id,name')
            ->where('status', 'paid');
        $failed = Payment::query()
            ->with('user:id,name')
            ->where('status', 'failed');
        $payouts = WithdrawalRequest::query()
            ->with(['owner:id,name', 'processor:id,name']);

        $this->applyDateRange($income, 'COALESCE(paid_at, updated_at, created_at)', $dateFrom, $dateTo);
        $this->applyDateRange($failed, 'COALESCE(updated_at, created_at)', $dateFrom, $dateTo);
        $this->applyDateRange($payouts, 'COALESCE(processed_at, requested_at, created_at)', $dateFrom, $dateTo);

        $incomeRows = $income->orderByDesc('paid_at')->orderByDesc('id')->get();
        $failedRows = $failed->orderByDesc('updated_at')->orderByDesc('id')->get();
        $payoutRows = $payouts->orderByDesc('processed_at')->orderByDesc('requested_at')->orderByDesc('id')->get();

        $filename = 'admin-transactions-' . now()->format('Ymd-His') . '.csv';

        return response()->streamDownload(function () use ($incomeRows, $failedRows, $payoutRows): void {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Section', 'Reference', 'Type', 'User/Owner', 'Status', 'Amount', 'Date']);

            foreach ($incomeRows as $row) {
                fputcsv($handle, [
                    'Income',
                    $row->order_id,
                    $row->type,
                    data_get($row, 'user.name', 'N/A'),
                    $row->status,
                    (float) $row->amount,
                    optional($row->paid_at ?? $row->updated_at ?? $row->created_at)?->format('Y-m-d H:i:s'),
                ]);
            }

            foreach ($failedRows as $row) {
                fputcsv($handle, [
                    'Failed',
                    $row->order_id,
                    $row->type,
                    data_get($row, 'user.name', 'N/A'),
                    $row->status,
                    (float) $row->amount,
                    optional($row->updated_at ?? $row->created_at)?->format('Y-m-d H:i:s'),
                ]);
            }

            foreach ($payoutRows as $row) {
                fputcsv($handle, [
                    'Payout',
                    'withdrawal:' . $row->id,
                    'withdrawal',
                    data_get($row, 'owner.name', 'N/A'),
                    $row->status,
                    (float) $row->amount,
                    optional($row->processed_at ?? $row->requested_at ?? $row->created_at)?->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function resolveDateRange(Request $request): array
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        if ($dateFrom && !preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) $dateFrom)) {
            $dateFrom = null;
        }

        if ($dateTo && !preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) $dateTo)) {
            $dateTo = null;
        }

        return [$dateFrom, $dateTo];
    }

    private function applyDateRange($query, string $columnExpression, ?string $dateFrom, ?string $dateTo): void
    {
        if ($dateFrom) {
            $query->whereRaw("DATE($columnExpression) >= ?", [$dateFrom]);
        }

        if ($dateTo) {
            $query->whereRaw("DATE($columnExpression) <= ?", [$dateTo]);
        }
    }
}
