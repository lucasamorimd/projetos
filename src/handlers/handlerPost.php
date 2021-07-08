<?php

namespace src\handlers;

use \src\models\Post;
use \src\models\Usuario;

class handlerPost
{
    public static function getIndexPosts($id)
    {
        $data = Post::select()->where('id_following', $id)->get();
        return count($data);
    }
    public static function getLastPost($data_criacao)
    {
        $data = array();
        $post = Post::select()->where('data_criacao', $data_criacao)->one();
        $post['data_criacao'] = date('d/m/Y H:i', strtotime($data_criacao));
        $user_post = Usuario::select(['nome', 'id_usuario', 'apelido', 'avatar'])
            ->where('id_usuario', $post['id_usuario'])
            ->one();
        $data = [
            'post' => $post,
            'user_post' => $user_post,
        ];
        return $data;
    }
}
