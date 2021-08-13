<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicoStoreRequest extends FormRequest
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
            'tipo_servico' => ['required', 'string', 'min:6'],
            'tempo_estimado' => ['required'],
            'preco' => ['required', 'numeric'],
            'descricao' => ['required'],
            'fotos_servico' => ['required', 'max:3'],
            'foto_principal' => ['required', 'image']
        ];
    }
    public function messages()
    {
        return [
            'nome.required' => 'Informar o nome do serviço',
            'tipo_servico.required' => 'Digitar o tipo do serviço (no plural)',
            'tipo_servico.min' => 'O tipo de serviço deve conter pelo menos 6 letras',
            'tempo_estimado.required' => 'Informar o tempo estimado de duração em horas',
            'preco.required' => 'Informar o valor do serviço',
            'descricao.required' => 'Informar uma descrição do serviço',
            'fotos_servico.max' => 'Selecione apenas 3 fotos!',
            'fotos_servico.image' => 'Selecione apenas arquivos de imagem!',
            'fotos_servico.required' => 'Escolha 3 fotos para ficarem no slideshow na área de agendamento',
            'foto_principal.required' => 'Escolha uma foto para ficar na tela principal',
            'foto_principal.image' => 'Selecione apenas arquivo de imagem (Exemplo.: jpg,png)'
        ];
    }
}
