<?php

namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'username'	             => 'required|unique:users|max:50',
            'email'	                => 'required|email|unique:users|max:150',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
