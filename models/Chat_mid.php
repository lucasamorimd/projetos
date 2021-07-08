<?php
require_once dirname(__DIR__) . '/autoload.php';
class Chat_mid
{
    private $pdo;
    private $base;
    private $dao;

    public function __construct(PDO $driver, $base)
    {
        $this->pdo = $driver;
        $this->base = $base;
        $this->dao = new ChatDaoMysql($this->pdo);
    }

    public function getChatsId($user_from, $user_to)
    {
        $msgDao = new MensagensDaoMysql($this->pdo);
        $mensagens = $msgDao->getMensagens($user_from, $user_to);
        return $mensagens;
    }
}
