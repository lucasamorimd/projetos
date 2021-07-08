<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeStoreRequest extends FormRequest
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
            'nome' => ['required', 'string', 'max:100'],
            'telefone' => ['required', 'string', 'max:100'],
            'endereco' => ['required', 'string'],
            'cidade' => ['required', 'string'],
            'estado' => ['required', 'string'],
            'cnpj' => ['required', 'string'],

        ];
    }
    public function messages()
    {
        return
            [
                'nome.required' => 'Digite o Nome da unidade',
                'telefone.required' => 'Digite o Telefone da unidade',
                'endereco.required' => 'Informe o Endereço da nova Unidade',
                'cidade.required' => 'Em qual Cidade está a nova unidade?',
                'estado.required' => 'Em qual Estado está a nova unidade?',
                'cnpj.required' => 'Informe o CNPJ da nova unidade corretamente',

            ];
    }
}
