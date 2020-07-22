<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MatchOldPassword;

class ChangePasswordUserRequest extends FormRequest
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
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['min:6'],
            'new_confirm_password' => ['same:new_password'],
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
            'current_password.required' => __('app.A current_password is required'),
            'new_password.required' => __('app.A new_password is required'),
            'new_password.min' => __('app.A new_password minimum 6 symbols'),
            'new_confirm_password.same' => __('app.A new_confirm_password must be equal new_password'),
        ];
    }
}
