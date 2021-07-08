<?php
require dirname(__DIR__) . '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

//$dir1 = $_GET['dir'];
$id_post_liked = filter_input(INPUT_POST, 'id_post');
$id_user_post = filter_input(INPUT_POST, 'id_user_post');

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
        $array['base'] = $base;
    } else {
        $array['aviso'] = "Curtir removido";
        $array['cor'] = 2;
    }
    $array['resultado'] = $resultado;
    $countLikes = new LikesDaoMysql($pdo);

    $array['countLikes'] = count($countLikes->getCountLikes($id_post_liked));
    $array['webSocket'] = "Like";
}
print_r(json_encode($array));
$_SESSION['aviso'] = null;
$_SESSION['cor'] = null;
