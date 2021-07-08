<?php

use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
//Rotas de Login e Cadastro
$router->get('/login', 'LoginController@unsigned');
$router->post('/login', 'LoginController@signin');
$router->get('/signup', 'LoginController@signup');
$router->post('/signup', 'LoginController@signupAction');
$router->get('/signout', 'LoginController@signout');

//Rotas do Perfil
$router->get('/profile/{id}', 'UserController@profile');

//Rotas de Post
$router->post('/post', 'PostController@post');
