<?php

namespace App\Http\Requests\FrontEnd\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerLoginFormRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required|min:8',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email is required !!!',

            'password.required' => 'Password is required !!!',
            'password.min' => 'Password must be greater than 8 letters !!!',
        ];
    }
}
