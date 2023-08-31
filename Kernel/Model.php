<?php
abstract class Model {
    private static $tableName;

    protected static function execute($sql) {
        $pdostatement = DBConnector::getConnect()->query($sql);
        return $pdostatement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getAll() {
        $tableName = static::$tableName;
        $sql = "SELECT * FROM $tableName";
        return static::execute($sql);
    }

    public static function getById($id) {
        /*
        $tableName = static::$tableName;
        $sql = "SELECT * FROM $tableName WHERE id=$id";
        return static::execute($sql);
        */
        $tableName = static::$tableName;
        $sql = "SELECT * FROM $tableName WHERE id = :id";
        $stmt = DBConnector::getConnect()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
