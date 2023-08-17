<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FundDuplicateWarning
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected int $fundId;

    public function __construct(int $fundId)
    {
        $this->fundId = $fundId;
    }

    public function getData(): array
    {
        return [
            'fund_id' => $this->fundId,
        ];
    }
}
