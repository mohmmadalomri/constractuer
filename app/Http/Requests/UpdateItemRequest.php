<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            //
            'name'          => 'max:255',
            'type'          =>  'max:255',
            'describe'      =>  'string',
            'price'          =>  'numeric',
            'image'          =>'image|max:20000,mimes:jpeg,jpg,png,svg|max:2048',
        ];
    }
}
