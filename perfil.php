<?php
require 'models/Auth.php';
require 'dao/FollowsDaoMysql.php';
require 'dao/PostsDaoMysql.php';
require 'autoload.php';
$activeMenu = "perfil";



if (isset($_GET['id'])) {
    $userIdInfo = $auth->checkPerfil($_GET['id']);
    $follow = new FollowsDaoMysql($pdo);
    $following = $follow->existsFollow($userInfo->id_usuario, $_GET['id']);
} else {
    $_GET['id'] = $userInfo->id_usuario;
}
$dir1 = basename($_SERVER['PHP_SELF']) . "?id=" . $_GET['id'];
$postsPerfilDao = new PostsDaoMysql($pdo);
$postsPerfil = $postsPerfilDao->getPerfilFeed($_GET['id'], $userInfo->id_usuario);


$title = $userInfo->nome;
require 'partials/header.php';
require 'partials/sidebar.php';
require 'partials/navbar.php';
?>
<div class="content">
    <div class="container-fluid">
        <?php if ($userInfo->id_usuario == $_GET['id']) {
            require 'partials/meu_perfil.php';
        } else {
            require 'partials/perfil_usuario.php';
        } ?>
    </div>
</div>
<?php require 'partials/scripts.php'; ?>
<script src="<?=$base?>/assets/js/ajax_functions/like.js"></script>
<script src="<?=$base?>/assets/js/ajax_functions/follow.js"></script>
</body>

</html>