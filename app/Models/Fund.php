<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Fund.
 *
 * @package namespace App\Models;
 */
class Fund extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'start_year', 'manager_id'];

    public function manager()
    {
        return $this->belongsTo(FundManager::class, 'manager_id', 'id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'funds_has_companies', 'fund_id', 'company_id');
    }

    public function aliases()
    {
        return $this->hasMany(FundAlias::class, 'fund_id', 'id');
    }
}
