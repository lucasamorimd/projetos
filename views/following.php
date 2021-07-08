<?php
$activeMenu = "seguindo";
require_once dirname(__DIR__). '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();


$title = "Lista de amigos";

$followMid = new Follow_mid($pdo, $base);
$userList = $followMid->listFollowingUsers($userInfo->id_usuario);
$dir1 = basename($_SERVER['PHP_SELF']);


require dirname(__DIR__) . '/partials.php';

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Lista de usuários</h4>
                        <p class="card-category">usuários que você está seguindo</p>
                    </div>
                    <div class="card-body">
                        <div class="responsive-table">
                            <?php require dirname(__DIR__) .'/partials/tabela_usuarios.php'; ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php require dirname(__DIR__) .'/partials/perfil_card.php'; ?>
        </div>
    </div>
</div>

<?php // require 'partials/footer.php';
?>
<?php require dirname(__DIR__) .'/partials/scripts.php'; ?>
</body>

</html>