<?php

namespace Yeelight\Transformers;

use Yeelight\Models\Foundation\User;

/**
 * Class UserTransformer
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
class UserTransformer extends BaseTransformer
{
    /**
     * Transform the User entity.
     *
     * @param User $model User
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'user_id' => (int) $model->getUserId(),

            'name'         => (string) $model->name,
            'gender'       => (string) $model->gender,
            'birthday'     => (string) $model->birthday,
            'country'      => (string) $model->country,
            'timezone'     => (string) $model->timezone,
            'locale'       => (string) $model->locale,
            'username'     => (string) $model->username,
            'phone_number' => (string) $model->phone_number,
            'email'        => (string) $model->email,
            'password'     => (string) $model->password,
            'status'       => (int) $model->status,
            'status_str'   => (string) $this->getStatusStrAttr($model),

            'created_by' => (string) $model->created_by,
            'created_at' => (string) $model->created_at,
            'created_ip' => (string) $model->created_ip,
            'updated_by' => (string) $model->updated_by,
            'updated_at' => (string) $model->updated_at,
            'updated_ip' => (string) $model->updated_ip,
        ];
    }

    private function getStatusStrAttr(User $model)
    {
        return $model->status == 0 ? '<span class="label label-danger">'.trans('users.columns.status_forbidden').'</span>' : '<span class="label label-success">'.trans('users.columns.status_normal').'</span>';
    }
}
