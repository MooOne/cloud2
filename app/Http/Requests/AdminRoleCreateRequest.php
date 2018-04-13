<?php

namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRoleCreateRequest extends FormRequest
{
    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'roles.create';


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
            'slug' => 'required|max:50',
            'name' => 'required|unique:admin_roles|max:50',
            'permissions' => 'array|required'
        ];
    }
}
