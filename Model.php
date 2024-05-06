<?php

namespace giuseppemuntoni\mvc;


use giuseppemuntoni\mvc\validation\Rule;

/**
 * Class Model
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc
 */
abstract class Model
{
    public array $errors = [];

    /**
     * @return array<int, Rule>
     */
    abstract protected function validationRules(): array;
    abstract public function getDisplayName(): string;
    abstract public function getLabel($attribute): string;

    public function load($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate(): bool
    {
        $rules = $this->validationRules();
        foreach ($rules as $rule) {
            $result = $rule->validate();
            if($result !== true) {
                $this->addError($rule->getAttribute(), $result);
            }
        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? null;
    }

}