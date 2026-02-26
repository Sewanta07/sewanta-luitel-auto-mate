<?php

namespace App\Events;

use App\Models\RentalRequest;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RentalStatusUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(public RentalRequest $rentalRequest)
    {
    }
}
