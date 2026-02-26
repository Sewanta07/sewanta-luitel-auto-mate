<?php

namespace App\Events;

use App\Models\ServiceBooking;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ServiceStatusUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(public ServiceBooking $serviceBooking)
    {
    }
}
