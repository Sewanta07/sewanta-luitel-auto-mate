<?php $__env->startSection('title', 'Transactions - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-trx-page">
    <div class="ad-trx-container">
        <div class="ad-trx-head">
            <h1 class="ad-trx-title">Transactions</h1>
            <p class="ad-trx-subtitle">System income, failed payments, and payout transactions</p>
        </div>

        <div class="ad-trx-filter-panel">
            <form method="GET" action="<?php echo e(route('admin.transactions')); ?>" class="ad-trx-filter-form">
                <div class="ad-trx-field">
                    <label class="ad-trx-label">From Date</label>
                    <input type="date" name="date_from" value="<?php echo e($dateFrom ?? request('date_from')); ?>" class="ad-trx-input" />
                </div>
                <div class="ad-trx-field">
                    <label class="ad-trx-label">To Date</label>
                    <input type="date" name="date_to" value="<?php echo e($dateTo ?? request('date_to')); ?>" class="ad-trx-input" />
                </div>
                <button type="submit" class="ad-trx-btn ad-trx-btn-primary">Apply</button>
                <a href="<?php echo e(route('admin.transactions')); ?>" class="ad-trx-btn ad-trx-btn-ghost">Reset</a>
                <a href="<?php echo e(route('admin.transactions.export', ['date_from' => $dateFrom, 'date_to' => $dateTo])); ?>" class="ad-trx-btn ad-trx-btn-dark">Export CSV</a>
            </form>
        </div>

        <div class="ad-trx-stats-grid">
            <div class="ad-trx-stat-card">
                <p class="ad-trx-stat-label">Total Income</p>
                <h3 class="ad-trx-stat-value">Rs. <?php echo e(number_format((float) ($totalIncome ?? 0), 2)); ?></h3>
            </div>
            <div class="ad-trx-stat-card">
                <p class="ad-trx-stat-label">Failed Transactions</p>
                <h3 class="ad-trx-stat-value"><?php echo e(number_format(($failedPayments ?? collect())->count())); ?></h3>
                <p class="ad-trx-text-red ad-trx-stat-note">Amount: Rs. <?php echo e(number_format((float) ($totalFailedAmount ?? 0), 2)); ?></p>
            </div>
            <div class="ad-trx-stat-card">
                <p class="ad-trx-stat-label">Paid Out</p>
                <h3 class="ad-trx-stat-value">Rs. <?php echo e(number_format((float) ($totalPayoutPaid ?? 0), 2)); ?></h3>
            </div>
            <div class="ad-trx-stat-card">
                <p class="ad-trx-stat-label">Pending Payout</p>
                <h3 class="ad-trx-stat-value">Rs. <?php echo e(number_format((float) ($pendingPayoutAmount ?? 0), 2)); ?></h3>
                <p class="ad-trx-stat-note">Pending owner earnings: Rs. <?php echo e(number_format((float) ($ownerPendingEarnings ?? 0), 2)); ?></p>
            </div>
        </div>

        <div class="ad-trx-grid-2 ad-trx-mb-8">
            <div class="ad-trx-panel">
                <h2 class="ad-trx-panel-title">Income Transactions</h2>
                <div class="ad-trx-table-wrap">
                    <table class="ad-trx-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Type</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Paid At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $incomeTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ad-trx-strong"><?php echo e($payment->order_id); ?></td>
                                    <td><?php echo e(ucfirst(str_replace('_', ' ', $payment->type))); ?></td>
                                    <td><?php echo e($payment->user->name ?? 'N/A'); ?></td>
                                    <td class="ad-trx-text-green ad-trx-strong">Rs. <?php echo e(number_format((float) $payment->amount, 2)); ?></td>
                                    <td class="ad-trx-muted"><?php echo e(optional($payment->paid_at ?? $payment->updated_at)->format('M d, Y h:i A')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="ad-trx-empty">No paid transactions found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="ad-trx-panel">
                <h2 class="ad-trx-panel-title">Failed Transactions</h2>
                <div class="ad-trx-table-wrap">
                    <table class="ad-trx-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Type</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $failedPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ad-trx-strong"><?php echo e($payment->order_id); ?></td>
                                    <td><?php echo e(ucfirst(str_replace('_', ' ', $payment->type))); ?></td>
                                    <td><?php echo e($payment->user->name ?? 'N/A'); ?></td>
                                    <td class="ad-trx-text-red ad-trx-strong">Rs. <?php echo e(number_format((float) $payment->amount, 2)); ?></td>
                                    <td class="ad-trx-muted"><?php echo e(optional($payment->updated_at)->format('M d, Y h:i A')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="ad-trx-empty">No failed transactions found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="ad-trx-panel">
            <h2 class="ad-trx-panel-title">Payout Transactions</h2>
            <div class="ad-trx-table-wrap">
                <table class="ad-trx-table">
                    <thead>
                        <tr>
                            <th>Owner</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Requested</th>
                            <th>Processed</th>
                            <th>Processed By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $payoutTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="ad-trx-strong"><?php echo e($payout->owner->name ?? 'N/A'); ?></td>
                                <td>Rs. <?php echo e(number_format((float) $payout->amount, 2)); ?></td>
                                <td>
                                    <?php
                                        $status = strtolower((string) $payout->status);
                                    ?>
                                    <span class="ad-trx-badge <?php echo e($status === 'paid' ? 'ad-trx-badge-green' : ($status === 'rejected' ? 'ad-trx-badge-red' : ($status === 'approved' ? 'ad-trx-badge-blue' : 'ad-trx-badge-yellow'))); ?>">
                                        <?php echo e(ucfirst($status)); ?>

                                    </span>
                                </td>
                                <td class="ad-trx-muted"><?php echo e(optional($payout->requested_at ?? $payout->created_at)->format('M d, Y h:i A')); ?></td>
                                <td class="ad-trx-muted"><?php echo e(optional($payout->processed_at)->format('M d, Y h:i A') ?? '-'); ?></td>
                                <td><?php echo e(data_get($payout, 'processor.name', '-')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="ad-trx-empty">No payout transactions found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\transactions\index.blade.php ENDPATH**/ ?>