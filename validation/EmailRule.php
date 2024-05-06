<?php

namespace app\core\validation;


/**
 * Class EmailRule
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package app\core\validation
 */
class EmailRule extends Rule
{
    protected function defaultError(): string
    {
        return "The attribute $this->attributeCaption must be a valid email address";
    }

    public function validate()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            return $this->error;
        } else {
            return true;
        }
    }
}