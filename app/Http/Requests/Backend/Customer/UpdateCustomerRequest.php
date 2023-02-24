<?php

namespace App\Http\Requests\Backend\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateCustomerRequest extends FormRequest
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
            'email' => 'required|unique:customers,email,' . $this->id,
            'password' => [
                'nullable',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'password_confirmation' => 'nullable|same:password',
            'status' => 'required|integer|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name Is Required',

            'email.required' => 'The Email Is Required',
            'email.email' => 'The Email Is Not Valid',
            'email.unique' => 'The Email Is Already Taken',

            'password.required' => 'The Password Is Required',
            'password.min' => 'The Password Must Be At Least 8 Characters',
            'password.confirmed' => 'The Password Confirmation Does Not Match',

            'status.integer' => 'Status must be an integer',
            'status.required' => 'Status is required',
            'status.numeric' => 'Status must be a number',
        ];
    }
}
