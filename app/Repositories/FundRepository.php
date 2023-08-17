<?php

namespace App\Repositories;

use App\Models\Fund;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface FundRepository.
 *
 * @package namespace App\Repositories;
 */
interface FundRepository extends RepositoryInterface
{
    public function hasDuplicate(Fund $fund): bool;
}
