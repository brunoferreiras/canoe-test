<?php

namespace App\Observers;

use App\Events\FundDuplicateWarning;
use App\Models\Fund;
use App\Repositories\FundRepository;

class FundObserver
{
    public function __construct(
        private FundRepository $repository
    ) {
    }

    public function created(Fund $fund): void
    {
        if ($this->repository->hasDuplicate($fund)) {
            FundDuplicateWarning::dispatch(
                $fund->id
            );
        }
    }
}
