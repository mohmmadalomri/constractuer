<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
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
            'client_id' =>'required',
            'title'    =>'required|string|max:200',
            'message'   =>'string',
            'subtotal'  =>'required',
            'discount'  =>'required',
            'type_discount' =>'required',
            'tax_name'      =>'required',
            'tax_describe'   =>'required',
            'tax_rate'      =>'required',
            'total'         =>'required',
            'note'         =>'required',
            'company_id'    =>'required',
        ];
    }
}
