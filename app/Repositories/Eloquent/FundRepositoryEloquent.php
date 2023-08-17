<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FundRepository;
use App\Models\Fund;

/**
 * Class FundRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class FundRepositoryEloquent extends BaseRepository implements FundRepository
{
    protected $fieldSearchable = [
        'name' => 'like',
        'start_year' => '=',
        'manager.name' => 'like',
        'manager.id' => '=',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Fund::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function hasDuplicate(Fund $fund): bool
    {
        return $this->getModel()->where('name', $fund->name)
            ->where('start_year', $fund->start_year)
            ->where('manager_id', $fund->manager_id)
            ->count() > 1;
    }
}
