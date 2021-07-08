<?php


require_once dirname(__DIR__) . '/rede_social/config.php';

//MODELS
require_once dirname(__DIR__) . '/rede_social/models/Auth.php';
require_once dirname(__DIR__) . '/rede_social/models/Chat.php';
require_once dirname(__DIR__) . '/rede_social/models/Comments.php';
require_once dirname(__DIR__) . '/rede_social/models/Follow.php';
require_once dirname(__DIR__) . '/rede_social/models/Likes.php';
require_once dirname(__DIR__) . '/rede_social/models/Mensagens.php';
require_once dirname(__DIR__) . '/rede_social/models/Posts.php';
require_once dirname(__DIR__) . '/rede_social/models/User.php';
require_once dirname(__DIR__) . '/rede_social/models/Upload.php';


//MIDDLEWARES
require_once dirname(__DIR__) . '/rede_social/models/Follow_mid.php';
require_once dirname(__DIR__) . '/rede_social/models/Likes_mid.php';
require_once dirname(__DIR__) . '/rede_social/models/Chat_mid.php';
require_once dirname(__DIR__) . '/rede_social/models/Posts_mid.php';

//DAO
require_once dirname(__DIR__) . '/rede_social/dao/ChatDaoMysql.php';
require_once dirname(__DIR__) . '/rede_social/dao/CommentsDaoMysql.php';
require_once dirname(__DIR__) . '/rede_social/dao/FollowsDaoMysql.php';
require_once dirname(__DIR__) . '/rede_social/dao/LikesDaoMysql.php';
require_once dirname(__DIR__) . '/rede_social/dao/MensagensDaoMysql.php';
require_once dirname(__DIR__) . '/rede_social/dao/PostsDaoMysql.php';
require_once dirname(__DIR__) . '/rede_social/dao/UserDaoMysql.php';

$follow_mid = new Follow_mid($pdo, $base);
$followsDaoMySql = new FollowsDaoMysql($pdo);
$chatMid = new Chat_mid($pdo, $base);
$chatDao = new ChatDaoMysql($pdo);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
