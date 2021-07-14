<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicoStoreRequest extends FormRequest
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
            'nome' => ['required', 'string', 'min:5'],
            'crm' => ['required'],
            'area_atuacao' => ['required'],
            'unidade' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Informe o nome do médico',
            'crm.required' => 'Informe a crendencial do méido',
            'area_atuacao.required' => 'Qual a área de formação do médico?',
            'unidade.required' => 'Selecione uma unidade onde o médico atuará'
        ];
    }
}
