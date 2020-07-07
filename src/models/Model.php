<?php
namespace App\Models;

// pas instancier directement
abstract class Model 
{
    // Pour être instanciable pour toute les classe fille
    private static $pdo;

    private static function setBdd()
    {
        self::$pdo = new \PDO('mysql:host=localhost;dbname=pnl;charset=utf8', 'root', '');
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);  
    }

    protected function getBdd()
    {
        if(self::$pdo === null)
        {
            self::setBdd();
        }
        return self::$pdo;
    }
}