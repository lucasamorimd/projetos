<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");
require dirname(__DIR__) . '/autoload.php';

$params = json_decode(file_get_contents("php://input"));

if ($params->id) {
    $dismiss = new NotificacaoDaoMysql($pdo);
    $dismiss->dismissNot($params->id);
}
