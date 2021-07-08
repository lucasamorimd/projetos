<?php
require_once dirname(__DIR__) . '/autoload.php';
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
    public function checkPost($id_post, $id_user)
    {
        if (!empty($id_post)) {
            return $this->dao->paginaPost($id_post, $id_user);
        }
    }
    public function getInsert($id_user, $data_criacao)
    {
        return $this->dao->getLastInsert($id_user, $data_criacao);
    }
}
