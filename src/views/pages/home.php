<?php $render('header', $usuario_dados); ?>

<?php $render('hero', $usuario_dados); ?>
<?php if ($_SESSION['swal']) : ?>
<?php $render('swallnot'); ?>
<?php
    $_SESSION['swal'] = null;
endif; ?>
<?php $render('footer'); ?>
<?php $render('scripts'); ?>