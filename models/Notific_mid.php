<?php

require_once dirname(__DIR__) . '/autoload.php';

class Notific_mid
{
    private $pdo;
    private $base;
    private $dao;
    private $UserDao;
    public function __construct(PDO $drive, $base)
    {
        $this->pdo = $drive;
        $this->base = $base;
        $this->dao = new NotificacaoDaoMysql($this->pdo);
        $this->UserDao = new UserDaoMysql($this->pdo);
    }

    public function gerarNotificacaoLike($id_user_from, $id_post_liked)
    {
        $postDao = new PostsDaoMysql($this->pdo);
        $user_from = $this->UserDao->paginaPerfil($id_user_from);
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
    public function gerarNotificacaoFollow($id_user_from, $id_user_to)
    {
        $user = $this->UserDao->paginaPerfil($id_user_from);
        $notific = new Notificacoes();
        $notific->titulo = "Follow";
        $notific->usuario_from = $id_user_from;
        $notific->usuario_to = $id_user_to;
        $notific->conteudo = "Você foi seguido por: " . $user->nome;
        $notific->avatar = $user->avatar;
        $notific->url = "/views/followed.php";
        $notific->data_notificacao = date("Y-m-d H:i:s");
        $this->dao->insertNotifiaction($notific);
        return $notific->data_notificacao;
    }
}
