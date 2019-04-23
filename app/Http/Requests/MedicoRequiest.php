<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicoRequiest extends FormRequest
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
            'name'=>'required|max:50';            
            'email'=>'max:50';
            'crm'=>'max:50';
            'fone'=>'max:20';
            'obs'=>'max:255';
            'ativo'=>'max:1';
        ];
    }
}
