<?php
require_once 'models/Auth.php';
require_once 'dao/UserDaoMysql.php';
require_once 'dao/FollowsDaoMysql.php';
require_once 'autoload.php';

$title = "Pesquisa Por Nome";

$dir1 = "";
$nome_pesquisa = filter_input(INPUT_POST, 'pesquisaNome');
$userDao = new UserDaoMysql($pdo);
$userList = $userDao->listUsersByName($nome_pesquisa);

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
                        <p class="card-category">usuários existentes na pesquisa</p>
                    </div>
                    <div class="card-body">

                        <?php require 'partials/tabela_usuarios.php';?>
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