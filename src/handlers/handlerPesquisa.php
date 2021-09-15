<?php

namespace src\handlers;

use src\models\Servico;
use src\models\Unidade;
use src\models\Unidade_servico;

class handlerPesquisa
{

    public function gerarPesquisa($ns)
    {
        //SELECIONAR SERVIÇOS DIGITADO
        $id_servicos = Servico::select(['id_servico', 'nome_servico', 'foto_principal', 'tipo_servico'])
            ->where('nome_servico', 'like', $ns['ns'] . '%')
            ->get('id_servico');
        if (count($id_servicos) > 0) {
            $obj = $this->gerarObjeto($id_servicos);
        } else {
            $obj = false;
        }
        return $obj;
    }
    private function gerarObjeto(array $array_servicos)
    {

        $arrayMount = [];

        //SELECIONAR ID DAS UNIDADES QUE CONTEM ESSE SERVIÇO
        foreach ($array_servicos as $servico) {
            //SELECIONAR UNIDADES A PARTIR DOS IDS SELECIONADOS
            $id_unidade =
                Unidade_servico::select('id_unidade')
                ->where('id_servico', $servico['id_servico'])
                ->get();
            //CRIAR UM ARRAY APENAS COM OS IDS DAS UNIDADES
            for ($i = 0; $i < count($id_unidade); $i++) {
                $idUni[$i] = $id_unidade[$i]['id_unidade'];
            }
            //CRIAR UM ARRAY COM OS DADOS DAS UNIDADES
            $unidades =
                Unidade::select(['id_unidade', 'nome_unidade', 'endereco_unidade'])
                ->whereIn('id_unidade', $idUni)
                ->get();
            //AGRUPAR O SERVIÇO COM AS ÚNIDADES QUE POSSUEM AQUELE SERVIÇO
            $arrayMount[] = [
                'servico' => $servico['nome_servico'],
                'id_servico' => $servico['id_servico'],
                'foto_servico' => $servico['foto_principal'],
                'tipo_servico' => $servico['tipo_servico'],
                'unidades' => $unidades
            ];
        }


        return $arrayMount;
    }
}
