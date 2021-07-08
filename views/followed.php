<?php
$activeMenu = "seguidores";
require_once dirname(__DIR__) . '/autoload.php';
$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();


$title = "Lista Seguidores";

$followMid = new Follow_mid($pdo, $base);
$userList = $followMid->listFollowed($userInfo->id_usuario);
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
                        <p class="card-category">usuários que seguem você</p>
                    </div>
                    <div class="card-body">
                        <div class="responsive-table">
                            <?php require dirname(__DIR__) . '/partials/tabela_usuarios.php'; ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php require dirname(__DIR__) . '/partials/perfil_card.php'; ?>
        </div>
    </div>
</div>

<?php // require 'partials/footer.php';
?>
<?php require dirname(__DIR__) . '/partials/scripts.php'; ?>
<script src="<?= $base ?>/assets/js/ajax_functions/follow.js"></script>
</body>

</html>