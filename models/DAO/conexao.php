<?php

class conexao
{
    public static function getinstance()
    {
        try {

            $pdo = new PDO("mysql:host=localhost;dbname=chat", "root", "");
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

            return $pdo;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
