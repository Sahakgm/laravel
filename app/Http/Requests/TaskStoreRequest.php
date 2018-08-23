<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
            'task_name' => 'sometimes|required|min:3|max:32',   // |unique:tasks
            'body' => 'sometimes|required'
        ];
    }

    public function messages()
    {
        return [
            'task_name.required' => 'The task name field is required',
            'task_name.min:3' => 'The task name must be at least 3 characters',
            'task_name.max:32' => 'The task name may not be greater than 32 characters',
            'body.required'  => 'The body field is required'
        ];
    }
}
