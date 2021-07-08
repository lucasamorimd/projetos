<?php
require 'config.php';
require 'models/Follow_mid.php';
require 'models/Likes_mid.php';
require 'models/Chat_mid.php';
$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$countFollowDao = new Follow_mid($pdo, $base);
$userConfigs = $auth->userConfigs($userInfo->id_usuario);
$countFollowing = $countFollowDao->listFollowingUsers($userInfo->id_usuario);
$countFollowed = $countFollowDao->listFollowed($userInfo->id_usuario);
$followingDao = new FollowsDaoMysql($pdo);
$chatMid = new Chat_mid($pdo, $base);
$chatDao = new ChatDaoMysql($pdo);
$chatRoom = $userInfo->id_usuario;
