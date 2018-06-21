<?php

namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'username'	=> [
                'required',
                Rule::unique('users')->ignore($this->username, 'username'),
                'max:50',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->email, 'email'),
                'max:150',
            ],
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
