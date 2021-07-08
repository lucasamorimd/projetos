<?php
require dirname(__DIR__) . '/funcoes.php';
$nome_usuario = explode(' ', $userInfo->nome);
if (isset($_SESSION['aviso'])) {
    $msg = $_SESSION['aviso'];
    $cor = $_SESSION['cor'];
    $not = "md.showNotification('top','right','" . $msg . ", " . $nome_usuario[0] . "!" . "','" . $cor . "')";
    $_SESSION['aviso'] = null;
    $_SESSION['cor'] = null;
} else {
    $not = null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= $base ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= $base ?>/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        <?= $title; ?>
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link type="text/css" href="<?= $base ?>/assets/css/material-dashboard.css" rel="stylesheet" />
    <link type="text/css" href="<?= $base ?>/assets/css/animations.css" rel="stylesheet" />
    <script src="<?= $base ?>/assets/js/animation.js"></script>
</head>

<body id="body" class="bg-dark" onload="<?= $not ?>">
    <div class="wrapper ">