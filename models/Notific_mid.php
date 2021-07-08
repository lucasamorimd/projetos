<?php

require_once dirname(__DIR__) . '/autoload.php';

class Notific_mid
{
    private $pdo;
    private $base;
    private $dao;
    public function __construct(PDO $drive, $base)
    {
        $this->pdo = $drive;
        $this->base = $base;
        $this->dao = new NotificacaoDaoMysql($this->pdo);
    }

    public function gerarNotificacaoLike($id_user_from, $id_post_liked)
    {
        $postDao = new PostsDaoMysql($this->pdo);
        $userDao = new UserDaoMysql($this->pdo);
        $user_from = $userDao->paginaPerfil($id_user_from);
        $postLiked = $postDao->getPost($id_post_liked);
        $notific = new Notificacoes();
        $notific->titulo = "Like";
        $notific->usuario_from = $id_user_from;
        $notific->usuario_to = $postLiked->id_usuario;
        $notific->conteudo = "Seu post foi curtido por " . $user_from->nome;
        $notific->avatar = $user_from->avatar;
        $notific->url = "/views/post_details.php?post=" . $id_post_liked;
        $notific->data_notificacao = date("Y/m/d H:i:s");
        $this->dao->insertNotifiaction($notific);
        return $notific->data_notificacao;
    }
}
