<?php

namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class AdminUserUpdateRequest
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
class AdminUserUpdateRequest extends FormRequest
{
    /**
     * Get the URL to redirect to on a validation error.
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
        return $this->getSession()->previousUrl();
    }

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
            'username' => [
                'required',
                Rule::unique('admin_users')->ignore($this->username, 'username'),
                'max:190',
            ],
            'name'                  => 'required|max:255',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'permissions'           => 'array',
            'roles'                 => 'array',
        ];
    }
}
