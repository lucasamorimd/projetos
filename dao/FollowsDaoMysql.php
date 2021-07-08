<?php
require_once 'models/Follow.php';

class FollowsDaoMysql implements FollowDao
{
    private $pdo;
    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }
    public function getFollows($id)
    {
        $follows = [$id];
        $sql = $this->pdo->prepare("SELECT id_followed FROM follow WHERE id_follower = :id_follower");
        $sql->bindValue(':id_follower', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            foreach ($data as $f) {
                $follows[] = $f['id_followed'];
            }
        }
        return $follows;
    }
    public function getFollowsTable($id)
    {
        $follows = [];
        $sql = $this->pdo->prepare("SELECT id_followed FROM follow WHERE id_follower = :id_follower");
        $sql->bindValue(':id_follower', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            foreach ($data as $f) {
                $follows[] = $f['id_followed'];
            }
        }
        return $follows;
    }
    public function getFollowedTable($id)
    {
        $follows = [];
        $sql = $this->pdo->prepare("SELECT id_follower FROM follow WHERE id_followed = :id_followed");
        $sql->bindValue(':id_followed', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            foreach ($data as $f) {
                $follows[] = $f['id_follower'];
            }
        }
        return $follows;
    }
    public function insertFollow(Follow $f)
    {
        $sql = $this->pdo->prepare("INSERT INTO follow(id_followed,id_follower) 
        VALUES(:id_followed, :id_follower)");
        $sql->bindValue(':id_followed', $f->id_followed);
        $sql->bindValue('id_follower', $f->id_follower);
        $sql->execute();
        return true;
    }
    public function existsFollow($id_follower, $id_followed)
    {
        if ($id_follower != $id_followed) {
            $sql = $this->pdo->prepare("SELECT id_follow FROM follow WHERE id_followed = :id_followed 
            AND id_follower = :id_follower");
            $sql->bindValue(':id_follower', $id_follower);
            $sql->bindValue(':id_followed', $id_followed);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $id_follow = $data['id_follow'];
                return $id_follow;
            }
        }else{
            return "me";
        }
        
    }
    public function unfollow($id)
    {
        $sql = $this->pdo->prepare("DELETE FROM follow WHERE id_follow = :id_follow");
        $sql->bindValue(':id_follow', $id);
        $sql->execute();

        return true;
    }
}
