<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
//            'first_name'          => 'required|max:100',
//            'last_name'          =>'required|max:100',
//            'name_company'          =>'required|max:100',
////            'phone'         => 'required',
//            'email'          => 'email|max:255|unique:companies,email',
//            'link_website'   =>'nullable|url',
//            'link_facebook'    =>'nullable|url',
//            'link_twitter'      =>'nullable|url',
//            'link_youtube'       =>'nullable|url',
//            'link_linkedin'      =>'nullable|url',
//            'address_1'         =>'required|string|max:255',
//            'address_2'          =>'nullable|string|max:255',
//            'country'            =>'required|string|max:30',
//            'governorate'       =>'required|string|max:30',
//            'city'              =>'required|string|max:30',
//            'zip_code'          =>'required|max:25',
        ];
    }
}
