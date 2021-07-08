<?php
class Follow
{
    public $id_follow;
    public $id_followed;
    public $id_follower;
}

interface FollowDao
{
    public function getFollows($id);
    public function insertFollow(Follow $f);
    public function existsFollow($id_follower, $id_followed);
    public function unfollow($id);
}
