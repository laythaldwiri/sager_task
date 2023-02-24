<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'status' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The Name Is Required',

            'status.integer' => 'Status must be an integer',
            'status.required' => 'Status is required',
        ];
    }
}
