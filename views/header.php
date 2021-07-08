<?php
session_start();
if(isset($_SESSION['aviso'])){
    $toast =" M.toast({html: '".$_SESSION['aviso']."'});";
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?php echo $titulo?></title>
</head>

<body>
    <script src="../assets/js/materialize.min.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/fun.js"></script>