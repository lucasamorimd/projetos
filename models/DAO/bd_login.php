<?php
session_start();
require_once('conexao.php');
class bd_login
{
    public function logar($usuario, $senha)
    {
        try {
            $pdo = conexao::getinstance();
            $sql = "SELECT * FROM usuario WHERE nome = ? AND senha = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $usuario);
            $stmt->bindValue(2, $senha);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user != NULL){
                $_SESSION['UserLogado'] = 1;
                $_SESSION['UserName'] = $user['nome'];
                return $user;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
