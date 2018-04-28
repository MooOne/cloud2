<?php

namespace Yeelight\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SocialiteAuthRequest extends FormRequest
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
            'email' => 'nullable|email',
            'provider' => 'required|in:xiaomi,facebook,twitter,google',
            'provider_user_id' => 'required',
            'oauth_data' => 'required|json',
            'expires_at' => 'required|date'
        ];
    }
}
