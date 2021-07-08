<?php
require_once('conexao.php');

class bd_usuario
{
    public function cadastrar(usuario $user)
    {
        try {
            $pdo = conexao::getinstance();
            $sql = "INSERT INTO usuario(nome, email, senha, token) values(?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $user->getNome());
            $stmt->bindValue(2, $user->getEmail());
            $stmt->bindValue(3, $user->getSenha());
            $stmt->bindValue(4, $user->getToken());
            $resultado = $stmt->execute();
            return $resultado;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function seguir($follower, $followed)
    {
        try {
            $pdo = conexao::getinstance();
            $sql = "INSERT INTO follow(id_followed, id_follower) values(?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $followed);
            $stmt->bindValue(2, $follower);
            $resultado = $stmt->execute();
            return $resultado;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
