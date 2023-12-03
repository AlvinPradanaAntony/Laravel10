<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'admin_commission' => 'required|regex:/^[0-9]\d*(\.\d+)?$/' ,
            'marketer_commission' => 'required|regex:/^[0-9]\d*(\.\d+)?$/',
            'package_price' => 'required|regex:/^[0-9]\d*(\.\d+)?$/',
            'weight_avaliable' => 'required',
            'gram_price' => 'sometimes|nullable|regex:/^[0-9]\d*(\.\d+)?$/',
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
            'name.required' => 'الأسم مطلوب',
            'admin_commission.required' => 'عمولة الأدمن مطلوب',
            'admin_commission.regex' => 'يجب ان يكون عدد عشري اوصحيح',
            'marketer_commission.required' => 'عمولة المسوق مطلوب',
            'marketer_commission.regex' => 'يجب ان يكون عدد عشري اوصحيح',
            'package_price.required' => 'سعر التغليف مطلوب',
            'package_price.regex' => 'يجب ان يكون عدد عشري اوصحيح',
            'weight_avaliable.required' => 'الوزن متاح مطلوب',
            'gram_price.regex' => 'يجب ان يكون عدد عشري اوصحيح',
        ];
    }

}
