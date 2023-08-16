<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FundAliasRepository;
use App\Models\FundAlias;

/**
 * Class FundAliasRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class FundAliasRepositoryEloquent extends BaseRepository implements FundAliasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FundAlias::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
