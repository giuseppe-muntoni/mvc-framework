<?php

namespace app\core\validation;


use app\core\validation\Rule;

/**
 * Class MinLengthRule
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package app\core\validation
 */
class MinLengthRule extends Rule
{
    private int $min;

    public function __construct($attribute, $attributeCaption, $value, $min, $error = null)
    {
        $this->min = $min;
        parent::__construct($attribute, $attributeCaption, $value, $error);
    }

    protected function defaultError(): string
    {
        return "The $this->attributeCaption attribute must be at least $this->min characters long.";
    }

    public function validate()
    {
        if (strlen($this->value) < $this->min) {
            return $this->error;
        } else {
            return true;
        }
    }
}