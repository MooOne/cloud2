<?php

namespace Yeelight\Traits;

use Yeelight\Models\Foundation\User;

/**
 * Trait RelationUserTrait
 *
 * @category Yeelight
 *
 * @package Yeelight\Traits
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
trait RelationUserTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
