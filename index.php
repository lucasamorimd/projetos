<?php

require 'models/Auth.php';
require 'dao/PostsDaoMysql.php';
require 'autoload.php';
$activeMenu = "home";
$title = "Inicial";

$postsDao = new PostsDaoMysql($pdo);
$post_item = $postsDao->getHomeFeed($userInfo->id_usuario);
$dir1 = basename($_SERVER['PHP_SELF']);

require 'partials/header.php';
require 'partials/sidebar.php';
require 'partials/navbar.php';
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <?php require 'partials/form_post.php'; ?>
                <?php foreach ($post_item as $item) : ?>
                    <?php require 'partials/posts.php'; ?>
                <?php endforeach; ?>
            </div>
            <?php require 'partials/perfil_card.php'; ?>
        </div>
    </div>
</div>
<?php require 'partials/scripts.php'; ?>
<script src="<?=$base?>/assets/js/ajax_functions/like.js"></script>
</body>
</html>