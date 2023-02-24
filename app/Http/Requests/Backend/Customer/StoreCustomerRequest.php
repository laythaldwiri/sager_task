<?php

namespace App\Http\Requests\Backend\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreCustomerRequest extends FormRequest
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
            'email' => 'required|email|unique:customers,email',
            'password' => [
                'required',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'password_confirmation' => 'required|same:password',
            'status' => 'required|integer|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',

            'email.email' => 'Email is not valid',
            'email.unique' => 'Email is already taken',

            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',

            'status.required' => 'Status is required',
            'status.integer' => 'Status is not valid',
            'status.numeric' => 'Status is not valid',
        ];
    }
}
