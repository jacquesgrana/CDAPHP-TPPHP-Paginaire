<?php
class Config {
    //private static $dsn = "mysql:host=localhost:3306;dbname=Test01;charset=utf8mb4";
    public const DB = 'paginaire';
    public const USER = 'admin';
    public const PASS = 'admin';
    public const DSN = 'mysql:dbname='.self::DB.';host=localhost:3306;charset=utf8mb4';

    public static function getEndpoint()
    {
        $protocol = 'http';
        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS']) {
                $protocol = 'https';
            }
        }
        return $protocol . '://' . $_SERVER['HTTP_HOST'] . '/';
    }
}
?>