<?php

session_start();
require_once 'conexao.php';

class bd_login {

    public function fazerLogin($email, $senha) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM empresa c WHERE c.email = ? AND c.senha = ?; ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $senha);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario != NULL) {
                $_SESSION['UsuarioLogado'] = 1;
                $_SESSION['id_empresa'] = $usuario['id_empresa'];
                $_SESSION['NomeUsuarioLogado'] = $usuario['nome'];
                $_SESSION['PerfilEmpresa'] = $usuario['perfil'];
                $_SESSION['cnpj'] = $usuario['cnpj'];
                $_SESSION['EmailEmpresa'] = $usuario['email'];
                $_SESSION['SenhaEmpresa'] = $usuario['senha'];
                $_SESSION['telefoneEmpresa'] = $usuario['telefone'];
                $_SESSION['LocalEmpresa'] = $usuario['emp_local'];
                return $usuario;
            }
        } catch (Exception $exc) {
            echo "erro" . $exc->getMessage();
        }
    }
    public function fazerLogout() {
        try {
            unset($_SESSION['UsuarioLogado']);
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    }