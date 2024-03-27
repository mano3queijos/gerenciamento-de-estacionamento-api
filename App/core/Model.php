<?php

namespace App\Core;

class Model {

    private static $conexao;

    public static function getConn(){

        if(!isset(self::$conexao)){
            self::$conexao = new \PDO("pgsql:host=localhost;port=5432;gerenciadorestacionamentodb;", "postgres", "0710");
        }

        return self::$conexao;
    }

}