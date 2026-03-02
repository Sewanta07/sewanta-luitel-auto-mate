<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice <?php echo e($booking->booking_code); ?></title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #1f2937;
            font-size: 12px;
            margin: 24px;
        }
        .head {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }
        .title {
            font-size: 22px;
            font-weight: 700;
            margin: 0;
        }
        .subtitle {
            margin: 4px 0 0;
            color: #6b7280;
        }
        .meta {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .meta td {
            width: 50%;
            vertical-align: top;
            padding: 6px 0;
        }
        .label {
            font-size: 10px;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: 3px;
        }
        .value {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
        }
        .muted {
            color: #6b7280;
            font-weight: 400;
        }
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            margin-bottom: 16px;
        }
        .items th,
        .items td {
            border: 1px solid #e5e7eb;
            padding: 8px;
        }
        .items th {
            background: #f9fafb;
            text-align: left;
            font-size: 11px;
        }
        .right {
            text-align: right;
        }
        .center {
            text-align: center;
        }
        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .summary td {
            padding: 6px 0;
        }
        .total {
            color: #ff5a1f;
            font-size: 16px;
            font-weight: 700;
        }
        .status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 999px;
            font-size: 10px;
            text-transform: uppercase;
            font-weight: 700;
        }
        .status-paid {
            background: #dcfce7;
            color: #166534;
        }
        .status-pending {
            background: #fef9c3;
            color: #854d0e;
        }
    </style>
</head>
<body>
    <?php ($partsTotal = $booking->parts->sum('pivot.total_cost')); ?>
    <?php ($payableAmount = ($booking->service_cost ?? 0) + ($booking->spare_parts_cost ?? 0) + $partsTotal); ?>

    <div class="head">
        <h1 class="title">Service Invoice</h1>
        <p class="subtitle">Booking <?php echo e($booking->booking_code); ?></p>
        <p class="subtitle" style="margin-top:8px; font-weight:700; color:#111827;"><?php echo e(config('billing.company_name', config('app.name', 'AutoMate'))); ?></p>
        <p class="subtitle" style="margin-top:2px;"><?php echo e(config('billing.tagline', 'Vehicle Service & Rental Management')); ?></p>
        <?php if(config('billing.address')): ?>
            <p class="subtitle" style="margin-top:2px;"><?php echo e(config('billing.address')); ?></p>
        <?php endif; ?>
        <p class="subtitle" style="margin-top:2px;">
            <?php echo e(config('billing.website')); ?> • <?php echo e(config('billing.email')); ?>

            <?php if(config('billing.phone')): ?>
                • <?php echo e(config('billing.phone')); ?>

            <?php endif; ?>
            <?php if(config('billing.vat')): ?>
                • VAT: <?php echo e(config('billing.vat')); ?>

            <?php endif; ?>
        </p>
    </div>

    <table class="meta">
        <tr>
            <td>
                <div class="label">Vehicle</div>
                <div class="value"><?php echo e($booking->vehicle_model); ?></div>
                <div class="muted"><?php echo e($booking->vehicle_number); ?> • <?php echo e($booking->vehicle_type); ?></div>
            </td>
            <td>
                <div class="label">Service</div>
                <div class="value"><?php echo e($booking->service_type); ?></div>
                <div class="muted"><?php echo e(\Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y')); ?> • <?php echo e($booking->preferred_time_slot); ?></div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="label">Priority</div>
                <div class="value"><?php echo e($booking->service_priority); ?></div>
            </td>
            <td>
                <div class="label">Location</div>
                <div class="value"><?php echo e($booking->service_location_type); ?></div>
            </td>
        </tr>
    </table>

    <div class="label" style="margin-bottom: 6px;">Parts Used</div>
    <table class="items">
        <thead>
            <tr>
                <th>Part</th>
                <th class="center">Qty</th>
                <th class="right">Unit Price</th>
                <th class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $booking->parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($part->part_name); ?></td>
                    <td class="center"><?php echo e($part->pivot->quantity); ?></td>
                    <td class="right">Rs. <?php echo e(number_format($part->pivot->unit_price, 2)); ?></td>
                    <td class="right">Rs. <?php echo e(number_format($part->pivot->total_cost, 2)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="center">No parts recorded.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <table class="summary">
        <tr>
            <td>Service Cost</td>
            <td class="right">Rs. <?php echo e(number_format($booking->service_cost ?? 0, 2)); ?></td>
        </tr>
        <tr>
            <td>Spare Parts Cost</td>
            <td class="right">Rs. <?php echo e(number_format($booking->spare_parts_cost ?? 0, 2)); ?></td>
        </tr>
        <tr>
            <td>Parts Total</td>
            <td class="right">Rs. <?php echo e(number_format($partsTotal, 2)); ?></td>
        </tr>
        <tr>
            <td><strong>Total Payable</strong></td>
            <td class="right total">Rs. <?php echo e(number_format($payableAmount, 2)); ?></td>
        </tr>
        <tr>
            <td>Payment Status</td>
            <td class="right">
                <span class="status <?php echo e(($booking->payment_status ?? 'pending') === 'paid' ? 'status-paid' : 'status-pending'); ?>">
                    <?php echo e(ucfirst($booking->payment_status ?? 'pending')); ?>

                </span>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/bookings/invoice-pdf.blade.php ENDPATH**/ ?>