<?php
$activeMenu = "home";
require dirname(__DIR__) . '/rede_social/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$title = "Inicial";


$postsDao = new PostsDaoMysql($pdo);
$post_item = $postsDao->getHomeFeed($userInfo->id_usuario);
$dir1 = basename($_SERVER['PHP_SELF']);

require dirname(__DIR__) . '/rede_social/partials.php';
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <?php require 'partials/form_post.php'; ?>
                <?php foreach ($post_item as $item) : ?>
                    <span id="post_create">
                        <?php require 'partials/posts.php'; ?>
                    </span>
                <?php endforeach; ?>
            </div>
            <?php require 'partials/perfil_card.php'; ?>
        </div>
    </div>
</div>
<?php require 'partials/scripts.php'; ?>
<script src="<?= $base ?>/assets/js/ajax_functions/posts.js"></script>
</body>

</html>