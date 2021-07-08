<?php
session_start();
$_SESSION['aviso'] = "Logout feito";
$_SESSION['token'] = null;

header("Location: index.php");
exit;