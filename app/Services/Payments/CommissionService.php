<?php

namespace App\Services\Payments;

class CommissionService
{
    public function calculateMarketplaceSplit(float $totalAmount, float $commissionRate = 0.10): array
    {
        $commissionAmount = round($totalAmount * $commissionRate, 2);
        $ownerEarning = round($totalAmount - $commissionAmount, 2);

        return [
            'total' => round($totalAmount, 2),
            'commission' => $commissionAmount,
            'owner_earning' => $ownerEarning,
            'commission_rate' => $commissionRate,
        ];
    }
}
