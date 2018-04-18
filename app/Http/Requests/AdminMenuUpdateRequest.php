<?php

namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminMenuUpdateRequest extends FormRequest
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
            'title' => 'required|max:50',
            'icon' => 'required|max:50'
        ];
    }
}
