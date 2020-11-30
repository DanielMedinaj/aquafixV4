<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            //Agregamos las reglas para validar en frontend
            'usuario' => 'required',
            'password' => 'required'

        ];
    }
        public function messages()
        {
            return [
                'usuario.required' => 'El nombre usuario es obligatorio.',
                'password.required' =>'El password es obligatorio.'
                
            ]; 
        }
        
            
        
    
    
    
    
}
