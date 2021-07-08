<?php
date_default_timezone_set("America/Sao_Paulo");
require dirname(__DIR__) . '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$novaMensagem = new Mensagens();
$novaMensagem->user_from = $userInfo->id_usuario;
$novaMensagem->user_to = filter_input(INPUT_POST, 'user_to');
$novaMensagem->conteudo = trim(filter_input(INPUT_POST, 'body'));
$novaMensagem->data_mensagem = date("Y-m-d");
$novaMensagem->hora_mensagem = date("H:i:s");
$novaMensagem->id_chat = $_SESSION['chat_id'];
$novaMensagem->nome_from = $userInfo->nome;
$novaMensagem->nome_to = filter_input(INPUT_POST, 'user_to_nome');

$msgDao = new MensagensDaoMysql($pdo);
$insertMensagem = $msgDao->insertMensagens($novaMensagem);
$novaMensagem->data_mensagem = date('d/m/Y');
$novaMensagem->hora_mensagem = date('H:i');
$novaMensagem->webSocket = "Mensagem";
$novaMensagem->base = $base;
print_r(json_encode($novaMensagem));
