<?php

namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Yeelight\Models\Menu;

class MenuUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can($this->getPermissionTag('update'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['name'] = 'required';
        $rules['slug'] = 'required';
        $rules['url'] = 'required';
        // 添加权限
        if (request()->isMethod('PUT') || request()->isMethod('PATH')) {
            // 修改时 request()->method() 方法返回的是 PUT或PATCH
            $rules['menu_id'] = 'numeric|required';
        }
        return $rules;
    }

    /**
     * 验证信息
     */
    public function messages()
    {
        return [
            'required'  => trans('validation.required'),
            'numeric'   => trans('validation.numeric'),
        ];
    }

    /**
     * 字段名称
     */
    public function attributes()
    {
        return [
            'name'      => trans('console/menu.model.name'),
            'url'       => trans('console/menu.model.url'),
            'slug'      => trans('console/menu.model.slug'),
            'menu_id'        => trans('console/menu.model.id'),
        ];
    }

    public function model()
    {
        return app()->make(Menu::class);
    }

    public function getPermissionTag($tag)
    {
        return $this->model()->getPermissionTag($tag);
    }
}
