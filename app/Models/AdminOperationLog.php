<?php

namespace Yeelight\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AdminOperationLog
 *
 * @category Yeelight
 *
 * @package Yeelight\Models
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class AdminOperationLog extends BaseModel implements Transformable
{
    use TransformableTrait;

    /**
     * Indicates if the model should be auto set user_id.
     *
     * @var bool
     */
    protected $autoUserId = false;

    /**
     * Indicates if the model should be recorded ips.
     *
     * @var bool
     */
    protected $ips = false;

    /**
     * Indicates if the model should be recorded users.
     *
     * @var bool
     */
    protected $update_users = false;

    protected $primaryKey = 'id';

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

    protected $fillable = ['user_id', 'path', 'method', 'ip', 'input'];

    public static $methodColors = [
        'GET'    => 'green',
        'POST'   => 'yellow',
        'PUT'    => 'blue',
        'DELETE' => 'red',
    ];

    public static $methods = [
        'GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH',
        'LINK', 'UNLINK', 'COPY', 'HEAD', 'PURGE',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('yeelight.backend.database.admin_operation_logs_table'));

        parent::__construct($attributes);
    }

    /**
     * Log belongs to users.
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(AdminUser::class);
    }
}
