<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'username' => "required|unique:users,username,{$this->id}",
            'phone' => 'required|min:10',
            'alt_phone' => 'required|min:10|different:phone',
            'address' => 'required',
            'balance' => 'required|regex:/^[0-9]\d*(\.\d+)?$/',
            'password' => 'sometimes|confirmed|min:8',
            'permission' => 'required',
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
            'username.required' => 'أسم المستخدم مطلوب',
            'username.unique' => 'أسم المستخدم مستخدم بالفعل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.min' => 'يجب أن يكون رقم الهاتف 10 ارقام',
            'alt_phone.required' => 'رقم الهاتف الأضافي مطلوب',
            'alt_phone.min' => 'يجب أن يكون رقم الهاتف الأضافي 10 ارقام',
            'alt_phone.different' => 'يجب أن يكون رقم الهاتف الأضافي مختلف عن رقم الهاتف',
            'address.required' => 'العنوان مطلوب',
            'balance.required' => 'الرصيد مطلوب',
            'balance.regex' => 'يجب ان يكون عدد عشري اوصحيح',
            'password.min' => 'طول الحد الأدني هو 8',
            'password.confirmed' => 'كلمة المرور لا تتطابق مع تأكيد كلمة المرور',
            'permission.required' => 'الصلاحيات مطلوبة',
        ];
    }

}
