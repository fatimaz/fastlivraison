<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentRequest extends FormRequest
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

             'expected_date' => 'required',
             'link' => 'required',
              'name' => 'required',
               'photo' => 'required_without:id|mimes:jpg,jpeg,png',
              'price' => 'required',
               'weight' => 'required',
               'qty' => 'required',
               'description' => 'required',
               'category_id' => 'required',
               'user_id' => 'required',
        ];
    }

}
