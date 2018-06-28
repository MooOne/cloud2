<?php

namespace Yeelight\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

/**
 * Class AuthRefreshRequest
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Requests\Api
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class AuthRefreshRequest extends FormRequest
{
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
            'grant_type'    => 'required',
            'client_id'     => 'required',
            'client_secret' => 'required',
            'refresh_token' => 'required',
        ];
    }
}
