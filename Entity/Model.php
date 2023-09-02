<?php
abstract class Model
{
    private static $tableName;

    protected static function execute($sql)
    {
        $pdostatement = DBConnector::getConnect()->query($sql);
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, self::getClassName());
    }

    public static function getAll($limit, $offset)
    {
        try {
            $tableName = static::$tableName;
            $sql = "SELECT * FROM $tableName LIMIT :limit OFFSET :offset";
            $stmt = DBConnector::getConnect()->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, self::getClassName());
            //return static::execute($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getById($id)
    {
        try {
            $tableName = static::$tableName;
            $sql = "SELECT * FROM $tableName WHERE id = :id";
            $stmt = DBConnector::getConnect()->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, self::getClassName());
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private static function getClassName()
    {
        return static::class;
    }

    public static function update(int $id, array $datas)
    {
        try {
            $setClause = [];
            $db = DBConnector::getConnect();
            foreach ($datas as $key => $value) {
                $value = $db->quote($value);
                $setClause[] = "`$key` = $value";
            }
            $setClauseString = implode(', ', $setClause);
            $tableName = static::$tableName;
            $sql = "UPDATE " . $tableName . " SET " . $setClauseString . " WHERE id = :id";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function insert(array $datas)
    {
        try {
            $setClause = [];
            $db = DBConnector::getConnect();
            foreach ($datas as $value) {
                if (is_int($value)) {
                    $setClause[] = "$value";
                } else {
                    $value = $db->quote($value);
                    $setClause[] = "$value";
                }
            }
            $setClauseString = implode(', ', $setClause);
            $tableName = static::$tableName;
            $sql = "INSERT INTO " . $tableName . " VALUES (" . $setClauseString . ")";
            //var_dump($sql);
            $stmt = $db->prepare($sql);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function delete(int $id) {
        $tableName = static::$tableName;
        $sql = "DELETE FROM ".$tableName." WHERE id=:id";
        $stmt = DBConnector::getConnect()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
