<?php
require 'models/Chat.php';
class ChatDaoMysql implements ChatDao
{
    private $pdo;
    public function __construct($drive)
    {
        $this->pdo = $drive;
    }
    public function insertChat($user_from, $user_to, $nome_to, $nome_from)
    {
        $sql = $this->pdo->prepare("INSERT INTO chat_usuarios(user_from, user_to, user_to_nome, user_from_nome) 
        values(:user_from, :user_to, :user_to_nome, :user_nome_from)");
        $sql->bindValue(':user_from', $user_from);
        $sql->bindValue(':user_to', $user_to);
        $sql->bindValue(':user_to_nome', $nome_to);
        $sql->bindValue(':user_nome_from', $nome_from);
        return $sql->execute();
    }
    public function existsChat($user_from, $user_to)
    {
        //$data = [];
        $sql = $this->pdo->prepare("SELECT id_chat FROM chat_usuarios 
        WHERE user_from = :user_from 
        AND user_to = :user_to");
        $sql->bindValue(':user_from', $user_from);
        $sql->bindValue(':user_to', $user_to);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        return false;
    }
    public function chatsId($user_from, $user_to)
    {
        $array = [];
        $sql = $this->pdo->prepare("SELECT id_chat FROM chat_usuarios WHERE user_from = :user_from AND user_to = :user_to OR user_from = :user_to AND user_to = :user_from");
        $sql->bindValue(':user_from', $user_from);
        $sql->bindValue(':user_to', $user_to);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $d){
                $array[] = $d['id_chat'];
            }
            
            return $array;
        }
        return false;
    }
    public function chatInfo($id_chat)
    {
        $sql = $this->pdo->prepare('SELECT * FROM chat_usuarios WHERE id_chat = :id_chat');
        $sql->bindValue(':id_chat', $id_chat);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getChats($id_user){
        $sql = $this->pdo->prepare('SELECT * FROM chat_usuarios WHERE user_from = :id_user');
        $sql->bindValue(':id_user', $id_user);
        $sql->execute();
        if($sql->rowCount()>0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            $listObj = $this->chatListToObj($data);
            return $listObj;
        }
    }

    private function chatListToObj($data){
        $array_lista = [];
        foreach($data as $d){
            $chatModel = new Chat();
            $chatModel->id_chat = $d['id_chat'];
            $chatModel->user_from=$d['user_from'];
            $chatModel->user_to=$d['user_to'];
            $chatModel->user_from_nome = $d['user_from_nome'];
            $chatModel->user_to_nome = $d['user_to_nome'];
            $array_lista[]= $chatModel;
        }
        return $array_lista;
        
    }
}
