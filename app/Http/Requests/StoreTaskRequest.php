<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'name'          => 'required|max:255',
            'describe'      => 'required',
            'project_id'    => 'required',
            'team_id'       => 'required',
            'start_time'    => 'required|date',
            'end_time'      => 'required|date',
            'status'         => 'required',
        ];
    }
}
