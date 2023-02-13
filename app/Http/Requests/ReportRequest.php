<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'user_id' => 'required',
            'order_id' => 'required',
            'message' => 'required',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'required' => 'هذا الحقل مطلوب',
    //         'message.string' => 'اسم اللغة لابد ان يكون احرف',
    //         'message.max' => 'اسم اللغة لابد الا يزيد عن 100 احرف ',
    //     ];
    // }
}
