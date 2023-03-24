<?php

namespace Leilao\Infra;

class ConnectionCreator
{
    private static $pdo = null;

    public static function getConnection(): \PDO
    {
        $data = Variaveis::variaveis();
        $host = $data['host'];
        $dbname = $data['dbname'];
        $password = $data['password'];

        if (is_null(self::$pdo)) {
            self::$pdo = new \PDO("mysql:host=$host;dbname=$dbname", 'root', $password);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }
}
