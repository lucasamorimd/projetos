<?php
date_default_timezone_set("America/Sao_Paulo");
require_once '../config.php';
require_once  '../models/Auth.php';
require_once  '../dao/CommentsDaoMysql.php';
require_once  '../models/Comments.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$commentsDao = new CommentsDaoMysql($pdo);
$newComment = new Comments();
$newComment->id_post = filter_input(INPUT_POST, 'id_post');
$newComment->id_user = $userInfo->id_usuario;
$newComment->data_criacao = date('Y/m/d H:i:s');
$newComment->body = trim(filter_input(INPUT_POST, 'body'));
$commentsDao->insertComments($newComment);
$newComment->data_criacao=date('d/m/Y H:i');
$newComent->nome_user = $userInfo->nome;
print_r(json_encode($newComment));
