<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'          => 'required',
            'email'         => 'email|max:255|unique:users,email',
            'phone'        => 'numeric|nullable|string|max:25',
            'image'     =>'image|max:20000,mimes:jpeg,jpg,png,svg|max:2048',
            'birth_day' =>'date',
        ];
    }
}
