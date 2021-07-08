<?php
require_once 'dao/UserDaoMysql.php';
class Auth
{
    private $pdo;
    private $base;
    private $dao;
    public function __construct(PDO $pdo, $base)
    {
        $this->pdo = $pdo;
        $this->base = $base;
        $this->dao = new UserDaoMysql($this->pdo);
    }
    public function checkToken()
    {
        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $user = $this->dao->findByToken($token);
            if ($user) {
                return $user;
            }
        }
        header("Location: " . $this->base . "/login.php");
        exit;
    }
    public function validateLogin($email, $senha)
    {
        $user = $this->dao->findByEmail($email);

        if ($user) {

            if (password_verify($senha, $user->senha)) {
                $token = md5(time() . rand(0, 9999));
                $_SESSION['token'] = $token;
                $user->token = $token;
                $this->dao->updateToken($user);
                return true;
            }
        }
        return false;
    }
    public function emailExists($email)
    {

        return $this->dao->findByEmail($email) ? true : false;
    }
    public function registerUser($nome, $email, $senha, $apelido)
    {
        $newUser = new User();

        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $token = md5(time() . rand(0, 9999));
        $newUser->nome = $nome;
        $newUser->email = $email;
        $newUser->senha = $hash;
        $newUser->apelido = $apelido;
        $newUser->token = $token;

        $this->dao->inserirUsuario($newUser);

        $_SESSION['token'] = $token;
    }
    public function updateUser($id_usuario, $nome, $email, $senha, $apelido, $descricao, $avatar)
    {

        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $token = md5(time() . rand(0, 9999));

        $this->dao->updatePerfil($id_usuario, $nome, $email, $hash, $token, $apelido, $descricao, $avatar);
        $_SESSION['token'] = $token;
        return true;
    }
    public function updateUserConfigs($id_usuario, $corNavBg, $corSeletor)
    {
        $existsUserConfig = $this->dao->existsUserConfig($id_usuario);
        if ($existsUserConfig == true) {
            $this->dao->updateUserConfig($id_usuario, $corNavBg, $corSeletor);
        } else {
            $this->dao->createUserConfig($id_usuario, $corNavBg, $corSeletor);
        }
    }
    public function userConfigs($id_usuario)
    {
        if (!empty($id_usuario)) {
            $existsUserConfig = $this->dao->existsUserConfig($id_usuario);
            if ($existsUserConfig == true) {
                $configs = $this->dao->findUserConfigs($id_usuario);
            } else {
                $configs = new User();
                $configs->navbar = 'white';
                $configs->seletor = 'purple';
            }
            return $configs;
        }
    }

    public function checkPerfil($id)
    {
        if (!empty($id)) {
            return $this->dao->paginaPerfil($id);
        }
    }
}
