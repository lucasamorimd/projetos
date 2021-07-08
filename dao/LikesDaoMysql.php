<?php
require_once dirname(__DIR__). '/autoload.php';

class LikesDaoMysql 
{
    private $pdo;
    public function __construct($drive)
    {
        $this->pdo = $drive;
    }
    public function insertLike(Likes $l)
    {
        $sql = $this->pdo->prepare("INSERT INTO postlikes(id_usuario,id_post,data_criacao
    ) VALUES(:id_usuario,:id_post, :data_criacao)");
        $sql->bindValue(':id_usuario', $l->id_usuario);
        $sql->bindValue(':id_post', $l->id_post);
        $sql->bindValue(':data_criacao', $l->data_criacao);
        $sql->execute();
        return true;
    }
    public function dislike($id_like)
    {
        $sql = $this->pdo->prepare("DELETE FROM postlikes WHERE id_like = :id_like");
        $sql->bindValue(':id_like', $id_like);
        $sql->execute();
        return true;
    }
    public function getCountLikes($id_post)
    {

        $sql = $this->pdo->prepare("SELECT * from postlikes where id_post = :id_post");
        $sql->bindValue(':id_post', $id_post);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        /*  echo "<pre>";
        var_dump($data);
        die('here');
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $this->gerarLikes($data);
        }*/
        return $data;
    }
    public function existsLike($id_usuario, $id_post)
    {
        $sql = $this->pdo->prepare("SELECT id_like FROM postlikes WHERE id_usuario = :id_usuario AND id_post = :id_post");
        $sql->bindValue(':id_usuario', $id_usuario);
        $sql->bindValue(':id_post', $id_post);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $id_like = $data['id_like'];
            return $id_like;
        }
    }
    private function gerarLikes($data)
    {
        $likes = [];
        foreach ($data as $newlike) {
            $u = new Likes();
            $u->id_like = $newlike['id_like'] ?? '';
            $u->id_usuario = $newlike['id_usuario'] ?? '';
            $u->id_post = $newlike['id_post'] ?? '';
            $u->data_criacao = $newlike['data_criacao'] ?? '';
            $likes[] = $u;
        }

        return $likes;
    }
}
