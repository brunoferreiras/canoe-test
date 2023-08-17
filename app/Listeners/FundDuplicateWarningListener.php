<?php

namespace App\Listeners;

use App\Events\FundDuplicateWarning;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class FundDuplicateWarningListener implements ShouldQueue
{
    public $connection = 'redis';
    public $queue = 'default';

    /**
     * Handle the event.
     */
    public function handle(FundDuplicateWarning $event): void
    {
        // TODO: add some logic in the future
        Log::info('FundDuplicateWarningListener executed: ', $event->getData());
    }
}
