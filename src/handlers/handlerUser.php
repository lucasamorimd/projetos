<?php

namespace src\handlers;

use \src\models\Usuario;
use \src\models\Post;
use \src\models\PostComment;
use \src\models\PostLike;

class handlerUser
{
    public static function getPerfil($id)
    {
        $array = array();
        $perfil = Usuario::select()->where('id_usuario', $id)->one();
        $post = Post::select()->where('id_usuario', $id)->get();
        if (count($post) > 0) {
            $postcomments = PostComment::select()
                ->where('id_post', $post['id_post'])
                ->get();
            $postlikes = PostLike::select()->where('id_post', $post['id_post'])->get();
            $array = [
                'perfil' => $perfil,
                'post' => $post,
                'postcomments' => count($postcomments),
                'postlikes' => count($postlikes)
            ];
        } else {
            $array = [
                'perfil' => $perfil,
                'post' => $post,
                'postcomments' => 0,
                'postlikes' => 0
            ];
        }
        return $array;
    }
}
