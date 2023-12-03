<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'delivery_price' => 'required|regex:/^[0-9]\d*(\.\d+)?$/',
            'delivery_man_id' => 'required',
            'status' => 'required',
            'added_price' => 'sometimes',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'delivery_price.required' => 'سعر التوصيل مطلوب',
            'delivery_price.regex' => 'يجب ان يكون عدد عشري او صحيح',
            'delivery_man_id.required' => 'رجل التوصيل مطلوب',
            'status.required' => 'يجب أختيار حالة للطلب',
        ];
    }

}

