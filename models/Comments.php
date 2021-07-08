<?php

class Comments{
    public $id_comments;
    public $id_post;
    public $id_user;
    public $data_criacao;
    public $nome_user;
    public $body;
}
interface CommentsDao{
    public function insertComments(Comments $c);
    public function listComments($id_post);
}