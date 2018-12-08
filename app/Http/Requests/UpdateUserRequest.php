<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|between:6,50|alpha_num',
            'password_confirmation' => 'required_with:password|same:password',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute is required',
            'email' => 'Incorrect email type',
            'unique' => 'The :attribute is unique',
            'between' => 'Please enter 6 to 50 alphanumeric characters.',
            'alpha_num' => 'Please enter with 6 to 50 half-width alphanumeric characters (including one or more letters each).',
            'required_with' => 'Required items are not entered.',
            'password_confirmation.same' => 'The two entered passwords do not match.'
        ];
    }
}
