<?php

namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminPermissionCreateRequest
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
class AdminPermissionCreateRequest extends FormRequest
{
    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'permissions.create';

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
            'slug'        => 'required|max:50',
            'name'        => 'required|unique:admin_permissions|max:50',
            'http_method' => 'array',
            'http_path'   => 'required',
        ];
    }
}
