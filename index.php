<?php
session_start();
if(isset($_SESSION['UserLogado'])){
    header('Location: views/chat.php');
    die();
}else{
    header('Location: views/login.php');
    die();
}