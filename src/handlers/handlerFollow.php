<?php

namespace src\handlers;

use \src\models\Follow;

class handlerFollow
{
    public static function getFollowings($id)
    {
        $data = Follow::select()->where('id_following', $id)->get();
        return count($data);
    }
    public static function getFollowers($id)
    {
        $data = Follow::select()->where('id_follower', $id)->get();
        return count($data);
    }
}
