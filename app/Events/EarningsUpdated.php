<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EarningsUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public int $ownerId,
        public float $ownerAmount,
        public float $commission,
        public string $context,
        public int $rentalId,
    ) {
    }
}
