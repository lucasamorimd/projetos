<?php

require_once dirname(__DIR__) . '/autoload.php';

class NotificacaoDaoMysql
{
    private $pdo;
    public function __construct($drive)
    {
        $this->pdo = $drive;
    }
    public function insertNotifiaction(Notificacoes $n)
    {
        $sql = $this->pdo->prepare("INSERT INTO 
        notificacoes(titulo,usuario_from, usuario_to,conteudo,url,avatar,data_notificacao) 
        VALUES(:titulo,:usuario_from,:usuario_to,:conteudo,:url,:avatar,:data_notificacao)");
        $sql->bindValue(':titulo', $n->titulo);
        $sql->bindValue(':usuario_from', $n->usuario_from);
        $sql->bindValue(':usuario_to', $n->usuario_to);
        $sql->bindValue(':conteudo', $n->conteudo);
        $sql->bindValue(':url', $n->url);
        $sql->bindValue(':avatar', $n->avatar);
        $sql->bindValue(':data_notificacao', $n->data_notificacao);
        $sql->execute();
        return true;
    }
    public function getNotificacoes($id_user)
    {
        $sql = $this->pdo->prepare("SELECT * FROM notificacoes WHERE usuario_to = :id_user AND is_seen = 0 ORDER BY id_notificacao DESC");
        $sql->bindValue(':id_user', $id_user);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            $notifics = $this->notificListToObject($data);
            return $notifics;
        }
    }
    public function getNotificacaoByDate($id_user, $data_notificacao)
    {
        $sql = $this->pdo->prepare("SELECT * FROM notificacoes WHERE usuario_to = :id_user AND data_notificacao = :data_notificacao");
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':data_notificacao', $data_notificacao);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }
    public function dismissNot($id_not)
    {
        $sql = $this->pdo->prepare('UPDATE notificacoes SET is_seen = 1 WHERE id_notificacao = :id_not');
        $sql->bindValue(':id_not', $id_not);
        $sql->execute();
        return true;
    }

    private function notificListToObject($data)
    {
        $array = [];
        foreach ($data as $not) {
            $notific = new Notificacoes();
            $notific->id_notificacoes = $not['id_notificacao'] ?? '';
            $notific->titulo = $not['titulo'] ?? '';
            $notific->usuario_from = $not['usuario_from'] ?? '';
            $notific->usuario_to = $not['usuario_to'] ?? '';
            $notific->conteudo = $not['conteudo'] ?? '';
            $notific->url = $not['url'] ?? '';
            $notific->avatar = $not['avatar'] ?? '';
            $array[] = $notific;
        }
        return $array;
    }
}
