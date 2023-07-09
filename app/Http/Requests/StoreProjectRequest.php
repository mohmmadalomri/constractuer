<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
//            'name'          =>'required|max:100',
//            'describe'      =>'required',
//            'budget'        =>'required|numeric',
//            'supervisor_id' =>'required|numeric',
//            'start_time'    =>'date',
//            'end_time'      =>'date',
//            'company_id'    =>'required',
//            'image'         =>'required|image'
        ];
    }
}
