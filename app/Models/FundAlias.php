<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class FundAlias.
 *
 * @package namespace App\Models;
 */
class FundAlias extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['alias', 'fund_id'];

    public function fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id', 'id');
    }
}
