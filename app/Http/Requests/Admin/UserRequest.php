<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $usernameRules = 'required';

        $allRules = [
            'name'          => 'required',
            'role'       => 'required',
        ];

        if ($this->isPostRequest()) {
            $allRules['password'] = 'required';
            $usernameRules .= '|unique:users';
        } else {
            $allRules['status'] = 'required';
        }

        $allRules['username'] = $usernameRules;

        return $allRules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        $messages = [
            'name.required' => __("User name is required"),
            'username.required' => __("Username is required"),
            'role.required' => __("Role is required"),

        ];
        if ($this->isPostRequest()) {
            $messages['username.unique']  = __('This username is already used');
            $messages['password.required'] = __("Password is required");
        } else {
            $messages['status.required'] = __('Status is required');
        }
        return $messages;
    }

    private function isPostRequest()
    {
        return request()->method() === "POST";
    }
}
