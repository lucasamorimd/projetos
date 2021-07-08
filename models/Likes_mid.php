<?php
require_once 'dao/LikesDaoMysql.php';
class Likes_mid
{
    private $pdo;
    private $base;
    private $dao;

    public function __construct(PDO $driver, $base)
    {
        $this->pdo = $driver;
        $this->base = $base;
        $this->dao = new LikesDaoMysql($this->pdo);
    }
    public function like($id_usuario, $id_post_liked){
        $is_liked = $this->dao->existsLike($id_usuario, $id_post_liked);
        if (null != $is_liked) {
            $this->dao->dislike($is_liked);
            return "disliked";
        } else {
            $likes = new Likes();
            $likes->id_usuario = $id_usuario;
            $likes->id_post = $id_post_liked;
            $likes->data_criacao = date('Y-m-d H:i:s');
            $this->dao->insertLike($likes);
            return "liked";
        }
        return false;
    }
}