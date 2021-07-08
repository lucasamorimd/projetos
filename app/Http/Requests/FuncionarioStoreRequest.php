<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioStoreRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:200', 'unique:funcionarios'],
            'senha' => ['required', 'string', 'min:4', 'confirmed'],
            'senha_confirmation' => ['required'],
            'unidade' => ['required'],
            'perfil' => ['required']
        ];
    }
    public function messages()
    {
        return [
            'nome.required' => 'Digite o nome completo do funcionário',
            'nome.string' => 'Informe um nome válido',
            'email.required' => 'Informe um email',
            'email.email' => 'Informe um email no formato exemplo@email.com',
            'email.unique' => 'Este e-mail já está cadastrado',
            'senha.required' => 'Informe a senha para o Funcionário novo',
            'senha.min' => 'A senha deve ter no mínimo 4 caracteres',
            'senha.confirmed' => 'Confirmação de senha não bate',
            'senha.required' => 'Confirme a senha para prosseguir',
            'unidade.required' => 'Selecione uma das Unidades cadastradas',
            'perfil.required' => 'Selecione um perfil'
        ];
    }
}
