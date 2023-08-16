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
        'start_year' => 'like',
        'manager.name' => 'like',
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
}
