<?php
$activeMenu = "perfil";
require_once dirname(__DIR__) . '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();




if (isset($_GET['id'])) {
    $userIdInfo = $auth->checkPerfil($_GET['id']);

    $following = $followsDaoMySql->existsFollow($userInfo->id_usuario, $_GET['id']);
} else {
    $_GET['id'] = $userInfo->id_usuario;
}
$dir1 = basename($_SERVER['PHP_SELF']) . "?id=" . $_GET['id'];
$postsPerfilDao = new PostsDaoMysql($pdo);
$postsPerfil = $postsPerfilDao->getPerfilFeed($_GET['id'], $userInfo->id_usuario);


$title = $userInfo->nome;

require dirname(__DIR__) . '/partials.php';

?>
<div class="content">
    <div class="container-fluid">
        <?php if ($userInfo->id_usuario == $_GET['id']) {
            require dirname(__DIR__) . '/partials/meu_perfil.php';
        } else {
            require dirname(__DIR__) . '/partials/perfil_usuario.php';
        } ?>
    </div>
</div>
<?php require dirname(__DIR__) . '/partials/scripts.php'; ?>
</body>

</html>