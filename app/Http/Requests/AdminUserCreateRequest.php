<?php

namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminUserCreateRequest
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Requests
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class AdminUserCreateRequest extends FormRequest
{
    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'users.create';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'              => 'required|unique:admin_users|max:190',
            'name'                  => 'required|max:255',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'permissions'           => 'array',
            'roles'                 => 'array',
        ];
    }
}
