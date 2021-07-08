<?php
require 'config.php';
require 'models/Auth.php';
require 'models/Likes_mid.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
//$dir1 = $_GET['dir'];
$id_post_liked = filter_input(INPUT_POST, 'post');
if ($id_post_liked) {
    $LikesMid = new Likes_mid($pdo, $base);
    $resultado = $LikesMid->like($userInfo->id_usuario, $id_post_liked);
    if ($resultado === 'liked') {
        $_SESSION['aviso'] =  "Curtido";
        $_SESSION['cor'] = 3;
    } else {
        $_SESSION['aviso'] = "Curtir removido";
        $_SESSION['cor'] = 2;
    }
}
echo $_SESSION['aviso'];
echo $_SESSION['cor'];
