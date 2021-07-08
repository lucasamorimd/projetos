<?php
require dirname(__DIR__) . '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$id = filter_input(INPUT_POST, 'id_follow');
$array = [];

if ($id) {
    $resultado = $follow_mid->followUser($userInfo->id_usuario, $id);
    $countFollows = $follow_mid->listFollowingUsers($userInfo->id_usuario);
    if ($resultado === "follow") {
        $array['aviso'] = "Seguindo";
        $array['cor'] = 3;
    } elseif ($resultado === "unfollow") {
        $array['aviso'] = "Você deixou de seguir ele(a)";
        $array['cor'] = 2;
    } else {
        $array['aviso'] = "Ocorreu algum erro! tente novamente";
        $array['cor'] = 2;
    }
    $array['resultado'] = $resultado;
    $array['countFollowings'] = count($countFollows);
    $array['webSocket'] = "Follow";
}
print_r(json_encode($array));
