<?php
class Posts
{
    public $id_posts;
    public $id_usuario;
    public $type;
    public $data_criacao;
    public $body;


}
interface PostsDao{
    public function insert(Posts $u);
    public function getHomeFeed($id_usuario);
}