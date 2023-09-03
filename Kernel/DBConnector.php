<?php
include_once('./Config/Config.php');

/**
 * Classe gérant la connexion à la bdd utilisant 
 * le design pattert singleton.
 */
class DBConnector extends PDO {
    private static $connexion;
              
    private final function __construct($dsn) { //, array $options
        parent::__construct($dsn, Config::USER, Config::PASS); //, $options
    }
     
    public static function getConnect() {
        if (!isset(self::$connexion)) {
            self::$connexion = new DBConnector(Config::DSN); //, self::$options
        } 
        return self::$connexion;
    }
}
?>