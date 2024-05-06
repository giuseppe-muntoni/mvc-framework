<?php

namespace giuseppemuntoni\mvc\db;


use giuseppemuntoni\mvc\Application;
use giuseppemuntoni\mvc\Model;

/**
 * Class DbModel
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\db
 */
abstract class DbModel extends Model
{

    abstract public static function primaryKey(): string;
    abstract public static function tableName(): string;
    abstract public function attributes(): array;

    public function save(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attribute) => ":$attribute", $attributes);

        try {
            $statement = self::prepare("INSERT INTO $tableName ("
                . implode(',', $attributes) . ")
                 VALUES (" . implode(',', $params) . ")");

            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $statement->execute();
        } catch (\PDOException $e) {
            // Log the error
            return false;
        }

        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
}