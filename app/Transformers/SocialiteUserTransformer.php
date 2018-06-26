<?php

namespace Yeelight\Transformers;

use Yeelight\Models\SocialiteUser;

/**
 * Class SocialiteUserTransformer
 *
 * @category Yeelight
 *
 * @package Yeelight\Transformers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class SocialiteUserTransformer extends BaseTransformer
{
    /**
     * Transform the SocialiteUser entity.
     *
     * @param SocialiteUser $model
     *
     * @return array
     */
    public function transform(SocialiteUser $model)
    {
        return [
            'socialite_user_id' => (int) $model->socialite_user_id,

            'user_id'          => (int) $model->user_id,
            'provider'         => (string) $model->provider,
            'provider_user_id' => (string) $model->provider_user_id,
            'oauth_data'       => (array) $model->created_by,
            'expires_at'       => (string) $model->created_by,

            'created_by' => (string) $model->created_by,
            'created_at' => (string) $model->created_at,
            'created_ip' => (string) $model->created_ip,
            'updated_by' => (string) $model->updated_by,
            'updated_at' => (string) $model->updated_at,
            'updated_ip' => (string) $model->updated_ip,
        ];
    }
}
