<?php
require_once 'models/User.php';
class UserDaoMysql implements UserChatDao
{
    public $pdo;
    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }
    private function gerarUsuario($data)
    {
        $u = new User();
        $u->id_usuario = $data['id_usuario'] ?? '';
        $u->nome = $data['nome'] ?? '';
        $u->email = $data['email'] ?? '';
        $u->senha = $data['senha'] ?? '';
        $u->apelido = $data['apelido'] ?? '';
        $u->token = $data['token'] ?? '';
        $u->descricao = $data['descricao'] ?? '';
        $u->avatar = $data['avatar'] ?? '';
        return $u;
    }
    private function gerarConfigs($data){
        $c = new User();
        $c->navbar = $data['navbar'] ?? 'white';
        $c->seletor = $data['seletor']?? 'purple';
        return $c;
    }
    private function gerarPerfil($data)
    {
        $u = new User();
        $u->id_usuario = $data['id_usuario'] ?? '';
        $u->nome = $data['nome'] ?? '';
        $u->email = $data['email'] ?? '';
        $u->apelido = $data['apelido'] ?? '';
        $u->descricao = $data['descricao'] ?? '';
        $u->avatar = $data['avatar'] ?? '';
        return $u;
    }
    public function findByToken($token)
    {
        $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE token = :token");
        $sql->bindValue(':token', $token);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $user = $this->gerarUsuario($data);
            return $user;
        }
        return false;
    }
    public function findUserConfigs($id_usuario){
        $sql = $this->pdo->prepare("SELECT * FROM configs WHERE id_usuario = :id_usuario");
        $sql->bindValue(':id_usuario', $id_usuario);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $config = $this->gerarConfigs($data);
            
            return $config;
        }
        return false;
    }
    public function findByEmail($email)
    {
        if (!empty($email)) {
            $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email");
            $sql->bindValue(':email', $email);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->gerarUsuario($data);
                return $user;
            }
            return false;
        }
    }
    public function updateToken(User $u)
    {
        $sql = $this->pdo->prepare("UPDATE usuario SET 
        token = :token
        WHERE id_usuario = :id_usuario
        ");
        $sql->bindValue(':token', $u->token);
        $sql->bindValue(':id_usuario', $u->id_usuario);
        $sql->execute();
        return true;
    }
    public function inserirUsuario(User $u)
    {

        $sql = $this->pdo->prepare("INSERT INTO usuario(nome, email, senha, token, apelido)
        VALUES(:nome, :email, :senha, :token, :apelido)");
        $sql->bindValue(':nome', $u->nome);
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':senha', $u->senha);
        $sql->bindValue(':token', $u->token);
        $sql->bindValue(':apelido', $u->apelido);
        $sql->execute();
        return true;
    }
    public function paginaPerfil($id)
    {
        if (!empty($id)) {
            $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
            $sql->bindValue(':id_usuario', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->gerarPerfil($data);
            }
            return $user;
        }
        return false;
    }
    public function updatePerfil($id_usuario, $nome, $email, $senha, $token, $apelido, $descricao, $avatar)
    {
        $sql = $this->pdo->prepare("UPDATE usuario SET
        nome = :nome,
        email = :email,
        senha = :senha, 
        token = :token,
        apelido = :apelido,
        descricao = :descricao,
        avatar = :avatar
        WHERE id_usuario = :id_usuario
        ");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->bindValue(':token', $token);
        $sql->bindValue(':apelido', $apelido);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':avatar', $avatar);
        $sql->bindValue(':id_usuario', $id_usuario);
        $sql->execute();
        return true;
    }
    public function listUsers($list_following)
    {
        $array = [];
        $sql = $this->pdo->query("SELECT * FROM usuario WHERE id_usuario IN(" . implode(',', $list_following) . ")");
        if ($sql != false) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            $array = $this->_followingListToObject($data);
        }
        return $array;
    }
    public function listUsersByName($nomeUser)
    {
        $userListByName = [];
        if (!empty($nomeUser)) {
            $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE nome LIKE  :nomeUser OR apelido LIKE :nomeUser ");
            $nomeUser = "%" . $nomeUser . "%";
            $sql->bindValue(':nomeUser', $nomeUser);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                $userListByName = $this->_listUserByNameToObj($data);
            }
        }
        return $userListByName;
    }
    public function existsUserConfig($id_usuario)
    {
        $sql = $this->pdo->prepare("SELECT id_config FROM configs WHERE id_usuario = :id_usuario");
        $sql->bindValue(':id_usuario', $id_usuario);
        $sql->execute();
        $config = $sql->fetch(PDO::FETCH_ASSOC);
        return $config;
    }
    public function createUserConfig($id_usuario, $corNavBg, $corSeletor)
    {
        if ($id_usuario) {
            $sql = $this->pdo->prepare("INSERT INTO configs(id_usuario, navbar, seletor) VALUES (:id_usuario, :navbar, :seletor)");
            $sql->bindValue(':id_usuario', $id_usuario);
            $sql->bindValue(':navbar', $corNavBg);
            $sql->bindValue(':seletor', $corSeletor);
            $sql->execute();
            return true;
        }
    }
    public function updateUserConfig($id_usuario, $corNavBg, $corSeletor)
    {
        if ($id_usuario) {
            $sql = $this->pdo->prepare("UPDATE configs SET id_usuario = :id_usuario, navbar = :corNavBg, seletor = :corSeletor WHERE id_usuario = :id_usuario");
            $sql->bindValue(':id_usuario', $id_usuario);
            $sql->bindValue(':corNavBg', $corNavBg);
            $sql->bindValue(':corSeletor', $corSeletor);
            $sql->execute();
            return true;
        }
    }
    private function _followingListToObject($data)
    {
        $array_following = [];

        foreach ($data as $following) {
            $objUser = new User();
            $objUser->id_usuario = $following['id_usuario'];
            $objUser->nome = $following['nome'];
            $objUser->email = $following['email'];
            $objUser->apelido = $following['apelido'];

            $array_following[] = $objUser;
        }
        return $array_following;
    }
    private function _listUserByNameToObj($data)
    {
        $array_list = [];
        foreach ($data as $userListName) {
            $objListUser = new User();
            $objListUser->id_usuario = $userListName['id_usuario'];
            $objListUser->nome = $userListName['nome'];
            $objListUser->email = $userListName['email'];
            $objListUser->apelido = $userListName['apelido'];
            $array_list[] = $objListUser;
        }
        return $array_list;
    }
}
