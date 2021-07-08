<?php
class User
{
    public $id_usuario;
    public $nome;
    public $senha;
    public $email;
    public $apelido; 
    public $descricao;
    public $avatar;
}

interface UserChatDao
{
    public function findByToken($token);
    public function findByEmail($email);
    public function updateToken(User $u);
    public function inserirUsuario(User $u);
    public function paginaPerfil($id);
}