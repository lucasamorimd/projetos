<?php
date_default_timezone_set("America/Sao_Paulo");
require dirname(__DIR__) . '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$commentsDao = new CommentsDaoMysql($pdo);
$newComment = new Comments();
$newComment->id_post = filter_input(INPUT_POST, 'id_post');
$newComment->id_user = $userInfo->id_usuario;
$newComment->data_criacao = date('Y/m/d H:i:s');
$newComment->body = trim(filter_input(INPUT_POST, 'body'));
$newComment->nome_user = $userInfo->nome;
$comment = $commentsDao->insertComments($newComment);
if ($comment == true) {
    $post_infos = new PostsDaoMysql($pdo);
    $post = $post_infos->getPost($newComment->id_post);
    $newComment->countComments = $post->countComments;
}
$newComment->data_criacao = date('d/m/Y H:i');

print_r(json_encode($newComment));
