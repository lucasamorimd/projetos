<?php
require 'models/Auth.php';
require 'autoload.php';
require_once 'dao/UserDaoMysql.php';
require_once 'dao/FollowsDaoMysql.php';
require_once 'dao/ChatDaoMysql.php';

$activeMenu = 'mensagens';
$title = "Mensagens";
if(!empty($_POST['pesquisaNome'])){
    $nome_pesquisa = $_POST['pesquisaNome'];
}else{
    $nome_pesquisa = null;
}
$chatDao = new ChatDaoMysql($pdo);
$userDao = new UserDaoMysql($pdo);
$userList = $userDao->listUsersByName($nome_pesquisa);
$chatList = $chatDao->getChats($userInfo->id_usuario);
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
                        <h4 class="card-title">Mensagens</h4>
                        <p class="card-category">procure um contato para conversar</p>
                    </div>
                    <div class="card-body">
                        <form id="formPesquisa" action="" method="POST">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="input-group no-border">
                                        <input name="pesquisaNome" type="search" value="" class="form-control" placeholder="Search...">
                                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                            <i class="material-icons">search</i>
                                            <div class="ripple-container"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                    <?php if (!empty($_POST['pesquisaNome'])) : ?>
                        <?php require 'partials/tabela_usuarios_mensagens.php'; ?>
                        <?php else:?>
                        <?php require 'partials/lista_chat.php';?>
                    <?php endif; ?>
                </div>
            </div>
            <?php require 'partials/perfil_card.php'; ?>
        </div>
    </div>
</div>

<?php // require 'partials/footer.php';
?>
<?php require 'partials/scripts.php'; ?>
</body>
</html>