<?php
date_default_timezone_set("America/Sao_Paulo");
require 'config.php';
require 'models/Auth.php';
require 'dao/PostsDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$body = filter_input(INPUT_POST, 'body');

if ($body) {
    $postdao = new PostsDaoMysql($pdo);
    $newPost = new Posts();
    $newPost->body = $body;
    $newPost->id_usuario = $userInfo->id_usuario;
    $newPost->type = 'text';
    $newPost->data_criacao = date("Y-m-d H:i:s");
    $postdao->insert($newPost);
}
header("Location:".$base);
exit;
