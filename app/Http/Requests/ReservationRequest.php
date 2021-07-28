<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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

            //'special_price' => 'required|numeric|min:0',
            'qty' => 'required|numeric|min:0',
            'code' => 'required|numeric',
            'stars' => 'required|numeric|min:0',
            'trip_id' => 'required|exists:trips,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required',

        ];
    }

}
