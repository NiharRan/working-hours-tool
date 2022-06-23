<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password'                       => 'required|confirmed|min:5',
            'password_confirmation'          => 'required|min:5',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'password.required' => __("Password is required"),
            'password.confirmed' => __("Password confirmation failed"),
            'password.min' => __("Password must contains minimum 6 character"),
            'password_confirmation.required' => __("Password confirmation required"),
            'password_confirmation.min' => __("Password must contains minimum 6 character"),
        ];
    }

    private function isPostRequest()
    {
        return request()->method() === "POST";
    }
}
