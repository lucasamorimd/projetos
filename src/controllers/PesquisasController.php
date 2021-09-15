<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\handlerLogin;
use \src\handlers\handlerPesquisa;


class PesquisasController extends Controller
{
    private $array = [
        'erro' => '',
        'results' => []
    ];
    public function __construct()
    {

        $this->loggedUser = handlerLogin::checkLogin();
        if ($this->loggedUser === false) {
            //Verifica se há usuário loggado, caso não haja, redireciona para a página inicial deslogada
            $this->array['erro'] = 'Não permitido';
            return json_encode($this->array);
        }
    }
    public function pesquisa_servico_nome($ns)
    {
        $handle = new handlerPesquisa;
        $objPesquisa = $handle->gerarPesquisa($ns);
        if (!$objPesquisa) {
            $this->array['erro'] = 'Não foi encontrado nenhum resultado';
        } else {
            $this->array['results'] = $objPesquisa;
        }
        echo json_encode($this->array);
    }
}
