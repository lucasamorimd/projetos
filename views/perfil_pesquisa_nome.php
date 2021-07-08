<?php
require_once dirname(__DIR__) . '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$title = "Pesquisa Por Nome";

$dir1 = "";
$nome_pesquisa = filter_input(INPUT_POST, 'pesquisaNome');
$userDao = new UserDaoMysql($pdo);
$userList = $userDao->listUsersByName($nome_pesquisa);

require dirname(__DIR__) . '/partials.php';
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

                        <?php require dirname(__DIR__) . '/partials/tabela_usuarios.php'; ?>
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
</body>

</html>