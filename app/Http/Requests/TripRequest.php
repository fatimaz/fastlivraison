<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
         
            'category_id' => 'required',
            'user_id' => 'required',
            'travel_date' => 'required',
             'weight_total' => 'required',
             'weight_free' => 'required',
             'note' => 'required',

        ];
    }

}
