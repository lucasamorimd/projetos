<?php
require_once dirname(__DIR__) . '/autoload.php';
class Follow_mid
{
    private $pdo;
    private $base;
    private $dao;

    public function __construct(PDO $driver, $base)
    {
        $this->pdo = $driver;
        $this->base = $base;
        $this->dao = new FollowsDaoMysql($this->pdo);
    }

    public function followUser($id_follower, $id_followed)
    {
        $followExists = $this->dao->existsFollow($id_follower, $id_followed);

        if (null != $followExists) {
            $this->dao->unfollow($followExists);
            return "unfollow";
        } else {
            $follow = new Follow();
            $follow->id_follower = $id_follower;
            $follow->id_followed = $id_followed;
            $this->dao->insertFollow($follow);
            return "follow";
        }
        return false;
    }
    public function listFollowingUsers($id_follower)
    {
        if ($id_follower) {
            $listFollowings =  $this->dao->getFollowsTable($id_follower);
            $userDao = new UserDaoMysql($this->pdo);
            $listUsers = $userDao->listUsers($listFollowings);
            return $listUsers;
        }
    }
    public function listFollowed($id_followed){
        if($id_followed){
            $listFollowed = $this->dao->getFollowedTable($id_followed);
            $userDao = new UserDaoMysql($this->pdo);
            $listUsers = $userDao->listUsers($listFollowed);
            return $listUsers;
        }
    }
}
