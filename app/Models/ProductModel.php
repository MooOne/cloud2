<?php

namespace Yeelight\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProductModel extends BaseModel implements Transformable
{
    use TransformableTrait;

    /**
     * Indicates if the model should be auto set user_id.
     *
     * @var bool
     */
    protected $autoUserId = true;

    /**
     * Indicates if the model should be recorded ips.
     *
     * @var bool
     */
    protected $ips = true;

    /**
     * Indicates if the model should be recorded users.
     *
     * @var bool
     */
    protected $update_users = true;

    protected $primaryKey = 'product_model_id';

    protected $fillable = [
        'title',
        'model_name',
        'code',
        'status',
    ];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];
}
