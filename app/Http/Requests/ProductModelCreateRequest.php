<?php
namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductModelCreateRequest
 * @package namespace Yeelight\Http\Requests;
 */
class ProductModelCreateRequest extends FormRequest
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
			'title' => 'required',
			'model_name' => 'required|max:150',
			'code' => 'required|max:50',
		];
    }
}
