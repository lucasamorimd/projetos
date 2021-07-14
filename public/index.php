<?php
session_start();
require dirname(__DIR__). '/vendor/autoload.php';
require dirname(__DIR__). '/src/routes.php';

$router->run( $router->routes );