<?php
require dirname(__DIR__). '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

//$dir1 = $_GET['dir'];
$id_post_liked = filter_input(INPUT_POST, 'id_post');
$array = [];
if ($id_post_liked) {
    $LikesMid = new Likes_mid($pdo, $base);
    $resultado = $LikesMid->like($userInfo->id_usuario, $id_post_liked);
    if ($resultado === 'liked') {
        $array['aviso'] =  "Curtido";
        $array['cor'] = 3;
    } else {
        $array['aviso'] = "Curtir removido";
        $array['cor'] = 2;
    }
    $array['resultado'] = $resultado;
    $countLikes = new LikesDaoMysql($pdo);
    $array['countLikes'] = count($countLikes->getCountLikes($id_post_liked));
}
print_r(json_encode($array));
$_SESSION['aviso'] = null;
$_SESSION['cor'] = null;