<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'email|max:255|unique:users,email',
            'password' => 'required|min:4',
            'phone' => 'numeric|nullable|string',
            'image' => 'image|max:20000,mimes:jpeg,jpg,png,svg|max:2048',
            'birth_day' => 'date',
        ];
    }
}
