<?php

if ($usuario_dados['usuario']->status == 0) {
    $render('header_unconfirmed', $usuario_dados);
} else {
    $render('header', $usuario_dados);
}
?>

<?php $render('hero', $usuario_dados); ?>
<?php if ($_SESSION['swal']) : ?>
<?php $render('swallnot'); ?>
<?php
    $_SESSION['swal'] = null;
endif; ?>
<?php $render('footer'); ?>
<?php $render('scripts'); ?>