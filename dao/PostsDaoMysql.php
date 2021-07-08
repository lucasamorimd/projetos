<?php
require_once dirname(__DIR__) . '/autoload.php';

class PostsDaoMysql
{
    private $pdo;
    public function __construct($drive)
    {
        $this->pdo = $drive;
    }
    public function insert(Posts $p)
    {
        $sql = $this->pdo->prepare("INSERT INTO posts(id_usuario, type, data_criacao, body
        ) VALUES(:id_usuario, :type, :data_criacao, :body)");
        $sql->bindValue(':id_usuario', $p->id_usuario);
        $sql->bindValue(':type', $p->type);
        $sql->bindValue(':data_criacao', $p->data_criacao);
        $sql->bindValue(':body', $p->body);
        $sql->execute();
        return true;
    }
    public function getLastInsert($id_user, $data_criacao)
    {
        $sql = $this->pdo->prepare("SELECT * FROM posts WHERE id_usuario = :id_user AND data_criacao = :data_criacao");
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':data_criacao', $data_criacao);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $lastPost = $this->gerarPost($data, $id_user);
            return $lastPost;
        }
        return false;
    }
    public function getHomeFeed($id_user)
    {
        $array = [];
        //1. Lista dos usuários que Eu sigo
        $followDao = new FollowsDaoMysql($this->pdo);
        $userList = $followDao->getFollows($id_user);


        //2. Lista dos posts ordenados por data
        $sql = $this->pdo->query("SELECT * FROM posts 
        WHERE id_usuario IN (" . implode(',', $userList) . ") ORDER BY data_criacao DESC");
        if ($sql != false) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            //3. Transformar resultado em objetos

            $array = $this->_postListToObject($data, $id_user);
        }

        return $array;
    }
    public function getPerfilFeed($id_perfil, $id_usuario)
    {
        $array = [];
        $sql = $this->pdo->prepare("SELECT * FROM posts WHERE id_usuario = :id_perfil ORDER BY data_criacao DESC");
        $sql->bindValue(':id_perfil', $id_perfil);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            $array = $this->_postListToObject($data, $id_usuario);
        }
        return $array;
    }

    public function paginaPost($id_post, $id_user)
    {
        if (!empty($id_post)) {
            $sql = $this->pdo->prepare("SELECT * FROM posts WHERE id_posts = :id_posts");
            $sql->bindValue(':id_posts', $id_post);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->gerarPost($data, $id_user);
            }
            return $user;
        }
        return false;
    }
    public function getPost($id_post)
    {
        $sql = $this->pdo->prepare("SELECT * FROM posts WHERE id_posts = :id_post");
        $sql->bindValue(':id_post', $id_post);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $list = $this->gerarPost($data, $data['id_usuario']);
            return $list;
        }
        return false;
    }
    private function gerarPost($data, $id_user)
    {
        $userDao = new UserDaoMysql($this->pdo);
        $likesDao = new LikesDaoMysql($this->pdo);
        $user = $userDao->paginaPerfil($data['id_usuario']);
        $p = new Posts();
        $p->id_usuario = $data['id_usuario'] ?? '';
        $p->id_posts = $data['id_posts'] ?? '';
        $p->type = $data['type'] ?? '';
        $p->data_criacao = $data['data_criacao'] ?? '';
        $p->body = $data['body'] ?? '';
        $p->nome = $user->nome;
        $p->apelido = $user->apelido;
        $p->avatar = $user->avatar;
        $p->descricao = $user->descricao;
        $contagem_likes = $likesDao->getCountLikes($data['id_posts']);
        if ($likesDao->existsLike($id_user, $data['id_posts'])) {
            $p->liked = true;
        } else {
            $p->liked = false;
        }
        $p->likeCount = count($contagem_likes) ?? 0;
        $commentsDao = new CommentsDaoMysql($this->pdo);
        $commentsList = $commentsDao->listComments($data['id_posts']);
        if ($commentsList) {
            $p->countComments = count($commentsList);
        } else {
            $p->countComments = 0;
        }

        $p->comments = $commentsList;
        return $p;
    }
    private function _postListToObject($post_list, $id_user)
    {
        $posts = [];
        $userDao = new UserDaoMysql($this->pdo);
        $likesDao = new LikesDaoMysql($this->pdo);
        foreach ($post_list as $post_item) {
            $newPost = new Posts();
            $newPost->id_posts = $post_item['id_posts'];
            $newPost->id_usuario = $post_item['id_usuario'];
            $newPost->type = $post_item['type'];
            $newPost->data_criacao = $post_item['data_criacao'];
            $newPost->body = $post_item['body'];
            $newPost->mine = false;
            if ($post_item['id_usuario'] == $id_user) {
                $newPost->mine = true;
            }
            //pegar informações do usuario
            $newPost->user = $userDao->paginaPerfil($post_item['id_usuario']);
            //informações sobre Likes
            $contagem_likes = $likesDao->getCountLikes($post_item['id_posts']);
            $newPost->likeCount = count($contagem_likes);
            if ($likesDao->existsLike($id_user, $post_item['id_posts'])) {
                $newPost->liked = true;
            } else {
                $newPost->liked = false;
            }
            $commentsDao = new CommentsDaoMysql($this->pdo);
            $commentsList = $commentsDao->listComments($post_item['id_posts']);
            if ($commentsList) {
                $newPost->countComments = count($commentsList);
            } else {
                $newPost->countComments = 0;
            }

            //informações sobre Coments

            $newPost->comments = [];


            $posts[] = $newPost;
        }

        return $posts;
    }
}
