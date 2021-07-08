<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestLogin extends FormRequest
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
            'email' => 'required',
            'password' => 'required',
            'email' => 'max:100',
            'password' => 'min:4'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Digite um email',
            'password.required' => 'Digite uma senha',
            'password.min' => 'A senha possui mais de 4 caracteres'
        ];
    }
}
