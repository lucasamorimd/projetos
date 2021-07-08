<?php
require dirname(__DIR__) . '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$id = filter_input(INPUT_POST, 'id_follow');
$array = [];

if ($id) {
    $resultado = $follow_mid->followUser($userInfo->id_usuario, $id);
    $countFollows = $follow_mid->listFollowingUsers($userInfo->id_usuario);
    $countFollowers = $follow_mid->listFollowed($id);
    if ($resultado === "follow") {
        $Notificacao = new Notific_mid($pdo, $base);
        $retorno = $Notificacao->gerarNotificacaoFollow($userInfo->id_usuario, $id);
        $array['aviso'] = "Seguindo";
        $array['cor'] = 3;
        $geraNot = new NotificacaoDaoMysql($pdo);
        $array['not'] = $geraNot->getNotificacaoByDate($id, $retorno);
        $array['countNot'] = count($geraNot->getNotificacoes($id)) ?? 0;
        $array['base'] = $base;
        $array['webSocket'] = "Follow";
    } elseif ($resultado === "unfollow") {
        $array['aviso'] = "Você deixou de seguir ele(a)";
        $array['cor'] = 2;
        $array['webSocket'] = "Unfollow";
    } else {
        $array['aviso'] = "Ocorreu algum erro! tente novamente";
        $array['cor'] = 2;
    }
    $array['id_unfollowed'] = $id;
    $array['id_unfollower'] = $userInfo->id_usuario;
    $array['countFollowers'] = count($countFollowers);
    $array['resultado'] = $resultado;
    $array['countFollowings'] = count($countFollows);
}
print_r(json_encode($array));
