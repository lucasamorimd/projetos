<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\handlerLogin;
use \src\models\Unidade;
use \src\models\Servico;
use \src\handlers\handlerServico;

class ServicosController extends Controller
{

    //Atributo que recebe os dados do usuário logado
    private $loggedUser;
    //Função que é executada sempre quando um método dessa classe é utilizado
    public function __construct()
    {
        //faz a requisição do usuário logado e insere os dados no atributo
        $this->loggedUser = handlerLogin::checkLogin();

        //Verifica se algo foi inserido no atributo de usuário logado
        if ($this->loggedUser === false) {
            //Se não houve nenhum resultado
            //redireciona para a página inicial sem usuário logado
            $this->redirect('/unsigned');
        }
    }

    //Método que seleciona as unidades registradas no banco
    public function unidades($servico)
    {
        //executa a requisição no banco de todas as unidades registradas
        $lista_unidades = Unidade::select()->execute();

        //Monta o array com os dados da unidade e o nome do serviço (exames, consultas ou procedimentos)
        $array = array(
            'lista_unidades' => $lista_unidades,
            'usuario_dados' => ['usuario' => $this->loggedUser],
            'nome_servico' => $servico['servico']
        );

        //renderiza a página de unidades enviando os dados
        $this->render('unidades', $array);
    }


    //Método que seleciona os serviços diponíveis
    public function getServicos($id)
    {
        //variável que obtem o retorno da função de requisição dos serviços disponíveis naquela unidade
        $servicos_disponiveis = handlerServico::getUnidadeServicos($id);

        //Monta o array com os dados retornados, dados de usuário, nome do serviço e o id da unidade que foi selecionada
        $array = [
            'usuario_dados' => ['usuario' => $this->loggedUser],
            'servicos' => $servicos_disponiveis,
            'id_unidade' => $id['id'],
            'nome_servico' => $id['servico']
        ];

        //renderiza a página com a lista de serviços disponíveis na unidade selecionada
        $this->render('servicos', $array);
    }
}
