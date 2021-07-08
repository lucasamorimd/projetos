<?php
date_default_timezone_set("America/Sao_Paulo");
require dirname(__DIR__) . '/autoload.php';

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
    $post = $postdao->insert($newPost);
    $newPost->nome = $userInfo->nome;
    if ($post == true) {
        $lastPostDao = new Posts_mid($pdo, $base);
        $lastPost = $lastPostDao->getInsert($userInfo->id_usuario, $newPost->data_criacao);
        $newPost->id_posts = $lastPost->id_posts;
        $newPost->avatar = $lastPost->avatar;
        $newPost->likeCount = $lastPost->likeCount;
        $newPost->type = $lastPost->type;
    }
    $newPost->data_criacao = date("d/m/Y H:i", strtotime($newPost->data_criacao));
    $newPost->base = $base;
    print_r(json_encode($newPost));
}
