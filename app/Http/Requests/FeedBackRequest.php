<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedBackRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'feedback' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute is required.',
            'email' => 'Please input a valid email address.',
            'unique' => 'This :attribute must be unique.',
        ];
    }
}
