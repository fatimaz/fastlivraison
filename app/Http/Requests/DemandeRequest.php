<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',       
        ];
    }

       public function messages()
       {
           return [
               'name.required'=> 'Le champ de nom est obligatoire.',
               'email.required' => 'Le champ de Email est obligatoire',
               'email.email' => 'Email doit être une adresse e-mail valide.',
               'phone.required' => 'Le champ de phone est obligatoire',
               'message.required' => 'Le champ de message est obligatoire',
           ];
       }
  

}
