<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class customerSignupRequestFormRequest extends FormRequest
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
            'email' => 'required|unique:users|unique:customers',
            'password' => [
                'required',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Full Name is required !!',
            'user_name.unique' => 'User Name is Already Exists !!',

            'email.required' => 'Email is required !!',
            'email.unique' => 'Email Already Exists !!',

            'password.required' => 'Password is required !!',
            'password.min' => 'Password must be greater than 8 characters !!',
            'password.confirmed' => 'Password does not match !!',
        ];
    }
}
