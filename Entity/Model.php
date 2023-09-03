<?php

/**
 * Classe abstraite qui est héritée par les entités liées à la bdd.
 */
abstract class Model
{
    private static $tableName;

    /**
     * Fonction qui renvoie un tableau d'objets contenant la liste 
     * des objets de la table. 
     * @Param : $limit : nombre d'enregistrements à renvoyer.
     * @Param : $offset : rang de départ(-1) à partir duquel on
     * doit renvoyer les objets.      
     * */
    public static function getAll(int $limit, int $offset)
    {
        try {
            $tableName = static::$tableName;
            $sql = "SELECT * FROM $tableName LIMIT :limit OFFSET :offset";
            $stmt = DBConnector::getConnect()->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, self::getClassName());
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Fonction qui renvoie un tableau d'objets contenant un objet selon
     * son id.
     * @Param : $id : id de l'objet à renvoyer.
     */
    public static function getById(int $id)
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

    /**
     * Fonction qui renvoit le nom de la classe.
     */
    private static function getClassName()
    {
        return static::class;
    }

    /**
     * Fonction qui exécute la mise à jour d'un livre en bdd selon son id.
     * @Param : $id : id de l'objet à mettre à jour.
     * @Param : $datas : tableau associatif contenant les données de 
     * l'objet à mettre à jour.
     */
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

    /**
     * Fonction qui exécute l'insertion d'un livre en bdd.
     * @Param : $datas : tableau associatif contenant les données de 
     * l'objet à insérer.
     */
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
            $stmt = $db->prepare($sql);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Fonction qui supprimer un objet de la bdd selon son id.
     * @Param : $id : id de l'objet à supprimer.
     */
    public static function delete(int $id) {
        $tableName = static::$tableName;
        $sql = "DELETE FROM ".$tableName." WHERE id=:id";
        $stmt = DBConnector::getConnect()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
