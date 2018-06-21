<?php

namespace Yeelight\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;
use Yeelight\Models\Basic\CountryModel;

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
            'username' => [
                'nullable',
                Rule::unique('users')->ignore($this->username, 'username'),
                'max:50',
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users')->ignore($this->email, 'email'),
            ],
            'gender'	=> [
                'nullable',
                Rule::in(['F', 'M']),
            ],
            'birthday' => 'nullable|date_format:Y-m-d',
            'country'  => [
                'nullable',
                Rule::in(CountryModel::getCountryISOCodeList()),
            ],
            'timezone' => 'nullable|timezone',
        ];
    }
}
