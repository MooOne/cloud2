<?php

namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPermissionCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //设置错误返回的表单地址
        $this->redirect = $this->session()->previousUrl();
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
            'slug' => 'required|max:50',
            'name' => 'required|unique:admin_permissions|max:50',
            'http_method' => 'array',
            'http_path' => 'required'
        ];
    }
}
