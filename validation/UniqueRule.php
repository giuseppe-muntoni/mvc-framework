<?php

namespace giuseppemuntoni\mvc\validation;


use giuseppemuntoni\mvc\Application;

/**
 * Class UniqueRule
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\validation
 */
class UniqueRule extends Rule
{

    private string $tableName;

    public function __construct($attribute, $attributeCaption, $value, $tableName, $error = null)
    {
        $this->tableName = $tableName;
        parent::__construct($attribute, $attributeCaption, $value, $error);
    }

    protected function defaultError(): string
    {
        return "The value $this->value for the attribute $this->attributeCaption is already in use.";
    }

    public function validate()
    {
        $statement = Application::$app->db->pdo->prepare(
            "SELECT $this->attribute FROM $this->tableName WHERE $this->attribute = :value"
        );
        $statement->bindValue(":value", $this->value);
        $statement->execute();

        return empty($statement->fetchAll(\PDO::FETCH_COLUMN)) ? true : $this->error;
    }
}