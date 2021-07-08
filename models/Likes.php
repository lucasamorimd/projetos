<?php

class Likes
{
    public $id_like;
    public $id_usuario;
    public $id_post;
    public $data_criacao;
}

interface LikesDao
{
    public function insertLike(Likes $l);
    public function dislike($id_like);
    public function getCountLikes($id_post);
    public function existsLike($id_usuario, $id_post);
}
