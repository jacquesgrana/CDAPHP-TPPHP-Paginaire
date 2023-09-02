<?php
include_once('./Config/Config.php');

class DBConnector extends PDO {
    //private static $dsn = Config::DSN; //"mysql:host=localhost:3306;dbname=Test01;charset=utf8mb4";
    /*
    private static $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // Disable emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Disable errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Make the default fetch be an associative array
      ];
    */
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