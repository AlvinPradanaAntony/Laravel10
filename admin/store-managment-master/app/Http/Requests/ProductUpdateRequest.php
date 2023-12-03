<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'weight' => 'required|regex:/^[0-9]\d*(\.\d+)?$/',
            'category_id' => 'required',
            'subcategory_id' => 'sometimes',
            'added_value' => 'required|regex:/^[0-9]\d*(\.\d+)?$/',
            'deducted_value' => 'required|regex:/^[0-9]\d*(\.\d+)?$/',
            'price' => 'required|regex:/^[1-9]\d*(\.\d+)?$/',
            'code' => "required|unique:products,code,{$this->id}",
            'image' => 'sometimes',
            'stock' => 'required',
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
            'name.required' => 'اسم المنتج مطلوب',
            'weight.required' => 'الوزن مطلوب',
            'weight.regex' => 'يجب ان يكون عدد عشري اوصحيح',
            'category_id.required' => 'التصنيف مطلوب',
            'added_value.required' => 'القيمة المضافة مطلوب',
            'added_value.regex' => 'يجب ان يكون عدد عشري اوصحيح',
            'deducted_value.required' => 'القيمة المخصصة مطلوبة',
            'deducted_value.regex' => 'يجب ان يكون عدد عشري اوصحيح',
            'price.required' => 'قيمة المنتج مطلوبة',
            'price.regex' => 'يجب ان يكون عدد عشري اوصحيح',
            'code.required' => 'الرمز مطلوب',
            'code.unique' => 'الرمز مستخدم',
            'stock.required' => 'كمية المخزن مطلوبة',
            // 'image.required' => 'يجب ان يحتوى المنتج على صورة',
        ];
    }

}


