<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssueRequest extends FormRequest
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
            'name' => 'required|max:255',
            'status_id' => 'required',
            'project_id' => 'required',
            'time' => 'numeric',
            'estimate' => 'numeric',
            'completion' => 'date',
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
            'name.required' => __('app.A name is required'),
            'status_id.required' => __('app.A status is required'),
            'project_id.required' => __('app.A project is required'),
            'time.numeric' => __('app.A time is numeric'),
            'estimate.numeric' => __('app.A estimate is numeric'),
            'completion.date' => __('app.A completion is date'),
        ];
    }
}
