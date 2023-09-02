<?php
abstract class Model {
    private static $tableName;

    protected static function execute($sql) {
        $pdostatement = DBConnector::getConnect()->query($sql);
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, self::getClassName());
    }
    
    public static function getAll($limit, $offset) {
        $tableName = static::$tableName;
        $sql = "SELECT * FROM $tableName LIMIT :limit OFFSET :offset";
        $stmt = DBConnector::getConnect()->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::getClassName());
        //return static::execute($sql);
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
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::getClassName());
    }

    private static function getClassName()
    {
        return static::class;
    }
}
?>
