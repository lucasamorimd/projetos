<?php
require_once dirname(__DIR__). '/autoload.php';

class MensagensDaoMysql
{
    private $pdo;
    public function __construct($drive)
    {
        $this->pdo = $drive;
    }
    public function getMensagens($user_from, $user_to)
    {
        $chatDao = new ChatDaoMysql($this->pdo);
        $id_chat = $chatDao->chatsId($user_from, $user_to);
        //$array_to_str = implode(',', $id_chat);
        $mensagens = [];
        $sql = $this->pdo->query("SELECT * FROM mensagens 
        WHERE id_chat IN (" . implode(',', $id_chat) . ") ORDER BY data_mensagem ASC");
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            $mensagens = $this->gerarMensagens($data);
            return $mensagens;
        }


        return false;
    }
    public function insertMensagens(Mensagens $m)
    {
        $sql = $this->pdo->prepare("INSERT INTO mensagens(user_from, user_to, conteudo, data_mensagem, hora_mensagem, id_chat)
        VALUES(:user_from, :user_to, :conteudo, :data_mensagem, :hora_mensagem, :id_chat)");
        $sql->bindValue(':user_from', $m->user_from);
        $sql->bindValue(':user_to', $m->user_to);
        $sql->bindValue(':conteudo', $m->conteudo);
        $sql->bindValue(':data_mensagem', $m->data_mensagem);
        $sql->bindValue(':hora_mensagem', $m->hora_mensagem);
        $sql->bindValue(':id_chat', $m->id_chat);
        $sql->execute();
        return true;
    }
    private function gerarMensagens($data)
    {
        $listaMensagens = [];
        $users = new UserDaoMysql($this->pdo);
        foreach ($data as $mensagem) {
            $newMensagem = new Mensagens();
            $newMensagem->id_mensagens = $mensagem['id_mensagens'];
            $newMensagem->user_from = $mensagem['user_from'];
            $newMensagem->user_to = $mensagem['user_to'];
            $newMensagem->conteudo = $mensagem['conteudo'];
            $newMensagem->data_mensagem = $mensagem['data_mensagem'];
            $newMensagem->hora_mensagem = $mensagem['hora_mensagem'];
            $newMensagem->id_chat = $mensagem['id_chat'];
            $user_from = $users->paginaPerfil($newMensagem->user_from);
            $user_to = $users->paginaPerfil($newMensagem->user_to);
            $newMensagem->user_info_from = $user_from;
            $newMensagem->user_info_to = $user_to;
            $listaMensagens[] = $newMensagem;
        }
        return $listaMensagens;
    }
}
