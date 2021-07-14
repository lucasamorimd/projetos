<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\handlerLogin;
use \src\models\Unidade;
use \src\models\Servico;
use \src\handlers\handlerServico;

class ServicosController extends Controller
{

    private $loggedUser;
    public function __construct()
    {
        $this->loggedUser = handlerLogin::checkLogin();
        if ($this->loggedUser === false) {
            $this->redirect('/unsigned');
        }
    }

    public function unidades($servico)
    {
        $lista_unidades = Unidade::select()->execute();
        $array = array(
            'lista_unidades' => $lista_unidades,
            'usuario_dados' => ['usuario' => $this->loggedUser],
            'nome_servico' => $servico['servico']
        );
        $this->render('unidades', $array);
    }

    public function getServicos($id)
    {
        $servicos_disponiveis = handlerServico::getUnidadeServicos($id);

        $array = [
            'usuario_dados' => ['usuario' => $this->loggedUser],
            'servicos' => $servicos_disponiveis,
            'id_unidade' => $id['id'],
            'nome_servico' => $id['servico']
        ];
        $this->render('servicos', $array);
    }

}
