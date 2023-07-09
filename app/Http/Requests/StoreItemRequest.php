<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
//            'name'          => 'required|max:255',
//            'type'          =>  'required|max:255',
//            'describe'      =>  'required',
//            'price'          =>  'required|numeric',
//            'image'          =>'image|mimes:jpeg,jpg,png,svg,webp',
        ];
    }
}
