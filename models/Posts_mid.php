<?php
require_once 'dao/PostsDaoMysql.php';
class Posts_mid
{
    private $pdo;
    private $base;
    private $dao;
    public function __construct(PDO $pdo, $base)
    {
        $this->pdo = $pdo;
        $this->base = $base;
        $this->dao = new PostsDaoMysql($this->pdo);
    }
    public function checkPost($id_post,$id_user)
    {
        if (!empty($id_post)) {
            return $this->dao->paginaPost($id_post, $id_user);
        }
    }
}
