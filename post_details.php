<?php
require 'models/Auth.php';
require 'models/Posts_mid.php';
require 'autoload.php';
$activeMenu = '';
$title = "Comentários";

if (isset($_GET['post'])) {
    $postsDao = new Posts_mid($pdo, $base);
    $post_details = $postsDao->checkPost($_GET['post'], $userInfo->id_usuario);
}

//$dir1 = basename($_SERVER['PHP_SELF'] . "?post=" . $_GET['post']);
$title = "Comentários";
$chatRoom = "comments".$_GET['post'];

require 'partials/header.php';
require 'partials/sidebar.php';
require 'partials/navbar.php';
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div id="comments_body" class="col-md-8">
                <?php require 'partials/posts_details.php'; ?>
                <?php if ($post_details->comments) : ?>
                    <?php foreach ($post_details->comments as $c) : ?>
                        <?php require 'partials/comments.php'; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php require 'partials/perfil_card.php'; ?>
        </div>
    </div>
</div>

<?php // require 'partials/footer.php';
?>
<?php require 'partials/scripts.php'; ?>
<script src="<?= $base ?>/assets/js/ajax_functions/comments.js"></script>
<script src="<?= $base ?>/assets/js/ajax_functions/like.js"></script>
</body>

</html>