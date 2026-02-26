<?php

namespace App\Events;

use App\Models\WithdrawalRequest;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WithdrawalStatusUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(public WithdrawalRequest $withdrawalRequest)
    {
    }
}
