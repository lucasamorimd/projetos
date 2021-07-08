<?php
$activeMenu = '';
require_once dirname(__DIR__). '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();


$title = "Comentários";

if (isset($_GET['post'])) {
    $postsDao = new Posts_mid($pdo, $base);
    $post_details = $postsDao->checkPost($_GET['post'], $userInfo->id_usuario);
}

//$dir1 = basename($_SERVER['PHP_SELF'] . "?post=" . $_GET['post']);
$title = "Comentários";


require dirname(__DIR__) . '/partials.php';
$chatRoom = "comments" . $_GET['post'];
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div id="comments_body" class="col-md-8">
                <?php require dirname(__DIR__) . '/partials/posts_details.php'; ?>
                <?php if ($post_details->comments) : ?>
                    <?php foreach ($post_details->comments as $c) : ?>
                        <?php require dirname(__DIR__) . '/partials/comments.php'; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php require dirname(__DIR__) . '/partials/perfil_card.php'; ?>
        </div>
    </div>
</div>

<?php // require 'partials/footer.php';
?>
<?php require dirname(__DIR__) . '/partials/scripts.php'; ?>
<script src="<?= $base ?>/assets/js/ajax_functions/comments.js"></script>
<script src="<?= $base ?>/assets/js/ajax_functions/like.js"></script>
</body>

</html>