<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCategoryRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:categories,name,' . $this->id,
            'status' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The Name Is Required',
            'name.unique' => 'Name is already taken',

            'status.integer' => 'Status must be an integer',
            'status.required' => 'Status is required',
        ];
    }
}
