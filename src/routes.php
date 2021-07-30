<?php

use core\Router;

$router = new Router();

//PÁGINA INICIAL LOGADO
$router->get('/', 'HomeController@index');

//PÁGINA INICIAL NÃO LOGADO
$router->get('/unsigned', 'LoginController@unsigned');

//AÇÃO DE LOGIN E LOGOUT
$router->post('/signin', 'LoginController@signin');
$router->get('/signout', 'LoginController@signout');

//PÁGINAS DE CADASTRO E AÇÕES DE CADASTRO
$router->get('/signup', 'LoginController@signup');
$router->post('/signup', 'LoginController@signupAction');

//PÁGINA UNIDADES
$router->get('/unidades/{servico}', 'ServicosController@unidades');


//PAGINA DE SERVIÇOS
$router->get('/unidades/{id}/{servico}', 'ServicosController@getServicos');


//PÁGINA DE SOLICITAÇÃO
$router->get('/unidades/{idunidade}/{nomeservico}/{idservico}/agendar', 'AgendamentosController@solicitar');
$router->post('/gethorarios/servico', 'AgendamentosController@horariosAjax');

//ACTIONS DE AGENDAR SERVICO
$router->post('/agendar-servico', 'AgendamentosController@agendarServico');


// ROTA DE CONFIRMAÇÃO DE EMAIL

$router->get('/usuarios/send-confirmation/{id}', 'ConfirmController@sendConfirm');
$router->get('/usuarios/confirmar/{id}', 'ConfirmController@confirm');

//PÁGINAS DE LISTAGEM DE AGENDAMENTOS ESSAS ROTAS SEMPRE POR ULTIMO
$router->get('/{servico}/{situacao}', 'AgendamentosController@listarServico');
$router->get('/{servico}/{situacao}/{id}', 'AgendamentosController@detalharServico');
$router->post('/cancelar-agendamento', 'AgendamentosController@cancelarAgendamento');
