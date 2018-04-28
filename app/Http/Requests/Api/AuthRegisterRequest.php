<?php

namespace Yeelight\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
            'client_id' => 'required',
            'client_secret' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ];
    }
}
