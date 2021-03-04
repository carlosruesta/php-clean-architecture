<?php


namespace Alura\Arquitetura\Infra\Persistencia;


use PDO;

class CriadorConexaoPdo
{

    private static $pdo = null;

    public static function criaConexao(): \PDO
    {

        if (is_null(self::$pdo)) {
            $caminhoBanco = __DIR__ . '/../../../banco.sqlite';
            self::$pdo = new \PDO('sqlite:' . $caminhoBanco);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }
}