<?php

require 'models/Auth.php';
require 'dao/ChatDaoMysql.php';
require 'dao/MensagensDaoMysql.php';

require 'autoload.php';

$activeMenu = "mensagens";
$title = "Chat";

$mensagensDao = new MensagensDaoMysql($pdo);

$chatInfo = $chatDao->chatInfo($_SESSION['chat_id']);
$mensagens = $chatMid->getChatsId($userInfo->id_usuario, $chatInfo['user_to']);
//$chatInfo = $chatDao->chatInfo($_SESSION['chat_id']);
$card = $auth->checkPerfil($chatInfo['user_to']);

//$chatExsists = $chatDao->existsChat($userInfo->id_usuario, $chatInfo['user_to']);
//$mensagens = $mensagensDao->getMensagens($_SESSION['chat_id']);


$dir1 = basename($_SERVER['PHP_SELF']);

require 'partials/header.php';
require 'partials/sidebar.php';
require 'partials/navbar.php';

?>
<style>
    #chatBody {
        height: 630px;
        overflow-y: auto;

    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card bg-dark">
                <div class="card-header card-header-primary text-center">
                    <h4 class="card-title "><?= $chatInfo['user_to_nome'] ?></h4>
                    <p class="card-category">&nbsp;</p>
                </div>
            </div>
            <div id="chatBody" class="col-md-8">

                <?php if (!empty($mensagens)) : ?>
                    <?php foreach ($mensagens as $m) : ?>
                        <?php if ($m->user_from === $userInfo->id_usuario) : ?>
                            <?php require 'partials/mensagens_from.php'; ?>
                        <?php else : ?>
                            <?php require 'partials/mensagens_to.php'; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php require 'partials/card_mensagens.php'; ?>
        </div>

    </div>
</div>
<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
</body>
</html>