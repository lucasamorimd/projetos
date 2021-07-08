<?php

session_start();
require_once 'conexao.php';

class bd_login_morador {

    public function fazerLogin($email, $senha) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM morador c WHERE c.email = ? AND c.senha = ?; ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $senha);
            $stmt->execute();
            $morador = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($morador != NULL) {
                $_SESSION['MoradorLogado'] = 1;
                $_SESSION['NomeMoradorLogado'] = $morador['nome'];
                $_SESSION['PerfilMorador'] = $morador['perfil'];
                $_SESSION['Condominio_Morador'] = $morador['id_condominio'];
                $_SESSION['EmailMorador'] = $morador['email'];
                $_SESSION['SenhaMorador'] = $morador['senha'];
                $_SESSION['telefoneMorador'] = $morador['telefone'];
                
                return $morador;
            }
        } catch (Exception $exc) {
            echo "erro" . $exc->getMessage();
        }
    }
    public function fazerLogout() {
        try {
            unset($_SESSION['MoradorLogado']);
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    }