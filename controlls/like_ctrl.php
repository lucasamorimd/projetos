<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");
require dirname(__DIR__) . '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();


$params = json_decode(file_get_contents("php://input"));

$id_post_liked = $params->id;
$id_user_post = $params->id_usuario;

$array = [];
if ($id_post_liked) {
    $LikesMid = new Likes_mid($pdo, $base);

    $resultado = $LikesMid->like($userInfo->id_usuario, $id_post_liked);
    if ($resultado === 'liked') {
        $Notificacao = new Notific_mid($pdo, $base);
        $retorno = $Notificacao->gerarNotificacaoLike($userInfo->id_usuario, $id_post_liked);
        $array['aviso'] =  "Curtido";
        $array['cor'] = 3;
        $geraNot = new NotificacaoDaoMysql($pdo);
        $array['not'] = $geraNot->getNotificacaoByDate($id_user_post, $retorno);
        $count = $geraNot->getNotificacoes($id_user_post);
        $array['countNot'] = $count ? count($count) : [];
        $array['base'] = $base;
        $array['webSocket'] = "Like";
    } else {
        $postDao = new PostsDaoMysql($pdo);
        $array['post'] = $postDao->getPost($id_post_liked);
        $array['aviso'] = "Curtir removido";
        $array['cor'] = 2;
        $array['webSocket'] = "Dislike";
    }
    $array['resultado'] = $resultado;
    $countLikes = new LikesDaoMysql($pdo);

    $array['countLikes'] = count($countLikes->getCountLikes($id_post_liked));
}
print_r(json_encode($array));
$_SESSION['aviso'] = null;
$_SESSION['cor'] = null;
