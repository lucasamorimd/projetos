<?php
require 'models/Auth.php';
require 'dao/PostsDaoMysql.php';
require 'autoload.php';
$activeMenu = "seguindo";
$title = "Lista de amigos";

$followMid = new Follow_mid($pdo, $base);
$userList = $followMid->listFollowingUsers($userInfo->id_usuario);
$dir1 = basename($_SERVER['PHP_SELF']);


require 'partials/header.php';
require 'partials/sidebar.php';
require 'partials/navbar.php';

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
                            <?php require 'partials/tabela_usuarios.php'; ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php require 'partials/perfil_card.php'; ?>
        </div>
    </div>
</div>

<?php // require 'partials/footer.php';
?>
<?php require 'partials/scripts.php'; ?>
<script src="<?=$base?>/assets/js/ajax_functions/follow.js"></script>
</body>

</html>