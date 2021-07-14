<?php

namespace src\controllers;

use \core\Controller;
use \src\models\Medico;
use \src\models\Servico;

use \src\handlers\handlerLogin;

class HomeController extends Controller
{

    private $loggedUser;
    public function __construct()
    {
        $this->loggedUser = handlerLogin::checkLogin();
        if ($this->loggedUser === false) {
            $this->redirect('/unsigned');
        }
    }
    public function index()
    {
        $lista_medicos = Medico::select()->execute();
        $lista_servicos = Servico::select()->execute();
        $lista_exames = [];
        $lista_consultas = [];
        $lista_procedimentos = [];
        foreach ($lista_servicos as $servico) {
            switch ($servico['tipo_servico']) {
                case 'exames':
                    $lista_exames[] = $servico;
                    break;
                case 'consultas':
                    $lista_consultas[] = $servico;
                    break;
                case 'procedimentos':
                    $lista_procedimentos[] = $servico;
                    break;
            }
        }
        $array = array(
            'usuario_dados' => ['usuario' => $this->loggedUser],
            'lista_medicos' => ['medicos' => $lista_medicos],
            'lista_servicos' => $lista_servicos,
            'lista_exames' => $lista_exames,
            'lista_consultas' => $lista_consultas,
            'lista_procedimentos' => $lista_procedimentos
        );
        $this->render('home', $array);
    }
    public function signup()
    {
        $this->render('cadastrar');
    }
}
