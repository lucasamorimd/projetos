<?php
require_once 'models/Comments.php';
class CommentsDaoMysql implements CommentsDao
{
    private $pdo;
    public function __construct($drive)
    {
        $this->pdo = $drive;
    }
    public function insertComments(Comments $c)
    {
        $sql = $this->pdo->prepare('INSERT INTO postcomments(id_post,id_user,data_criacao,body,nome_user
        ) VALUES(:id_post,:id_user,:data_criacao,:body,:nome_user)');
        $sql->bindValue(':id_post', $c->id_post);
        $sql->bindValue(':id_user', $c->id_user);
        $sql->bindValue(':data_criacao', $c->data_criacao);
        $sql->bindValue(':body', $c->body);
        $sql->bindValue(':nome_user', $c->nome_user);
        $sql->execute();
        return true;
    }
    public function listComments($id_post)
    {
        $sql = $this->pdo->prepare('SELECT * FROM postcomments WHERE id_post = :id_post');
        $sql->bindValue(':id_post', $id_post);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            $commentsList = $this->listCommentsToObj($data);
            return $commentsList;
        }
        return false;
    }

    private function listCommentsToObj($data)
    {
        $array = [];
        foreach ($data as $c) {
            $commentsList = new Comments();
            $commentsList->id_comments = $c['id_comments'];
            $commentsList->id_post = $c['id_post'];
            $commentsList->id_user = $c['id_user'];
            $commentsList->data_criacao = $c['data_criacao'];
            $commentsList->body = $c['body'];
            $commentsList->nome_user = $c['nome_user'];
            $array[] = $commentsList;
        }
        return $array;
    }
}
