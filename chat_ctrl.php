<?php
require 'models/Auth.php';
require 'dao/ChatDaoMysql.php';
require 'autoload.php';

$chatDao = new ChatDaoMysql($pdo);
$user_to = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$user_to_nome = filter_input(INPUT_GET, 'nome_to');
$chatExists = $chatDao->existsChat($userInfo->id_usuario, $user_to);



if (!empty($_GET['id']) && $chatExists === false) {
    if ($_GET['id'] != $userInfo->id_usuario) {
        $chatDao->insertChat($userInfo->id_usuario, $user_to, $user_to_nome, $userInfo->nome);
        $id_chat = $chatDao->existsChat($userInfo->id_usuario, $user_to);
        $_SESSION['chat_id'] = $id_chat['id_chat'];
    }else{
        $_SESSION['aviso'] = "Não permitido abrir o chat com vc mesmo";
        header("Location:".$base."/mensagens.php");
        exit;
    }
} else {

    $_SESSION['chat_id'] = $chatExists['id_chat'];
}
header("Location:" . $base . "/chat.php");
exit;
