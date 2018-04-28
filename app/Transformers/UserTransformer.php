<?php
namespace Yeelight\Transformers;

use Yeelight\Models\Foundation\User;

/**
 * Class UserTransformer
 * @package namespace Yeelight\Transformers;
 */
class UserTransformer extends BaseTransformer
{

    /**
     * Transform the User entity
     * @param User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'user_id' => (int) $model->getUserId(),

            'name' => (string) $model->name,
            'gender' => (string) $model->gender,
            'birthday' => (string) $model->birthday,
            'country' => (string) $model->country,
            'timezone' => (string) $model->timezone,
            'locale' => (string) $model->locale,
            'username' => (string) $model->username,
            'phone_number' => (string) $model->phone_number,
            'email' => (string) $model->email,
            'password' => (string) $model->password,
            'status' => (int) $model->status,

            'created_by' => (string) $model->created_by,
            'created_at' => (string) $model->created_at,
            'created_ip' => (string) $model->created_ip,
            'updated_by' => (string) $model->updated_by,
            'updated_at' => (string) $model->updated_at,
            'updated_ip' => (string) $model->updated_ip
        ];
    }
}
