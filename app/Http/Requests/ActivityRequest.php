<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
        $allRules = [];
        if ($this->isPostRequest()) {
            $allRules = [
                'user_id'          => 'required',
                'project_id'       => 'required',
            ];
        }

        return $allRules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $allMessages = [];
        if ($this->isPostRequest()) {
            $allMessages = [
                'user_id.required' => __("User is required"),
                'project_id.required' => __("Project is required")

            ];
        }

        return $allMessages;
    }

    private function isPostRequest()
    {
        return request()->method() === "POST";
    }
}
