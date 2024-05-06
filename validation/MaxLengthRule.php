<?php

namespace giuseppemuntoni\mvc\validation;


/**
 * Class MaxLengthRule
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\validation
 */
class MaxLengthRule extends Rule
{
    private int $max;

    public function __construct($attribute, $attributeCaption, $value, $max, $error = null)
    {
        $this->max = $max;
        parent::__construct($attribute, $attributeCaption, $value, $error);
    }

    protected function defaultError(): string
    {
        return "The $this->attributeCaption attribute must be at most $this->max characters long.";
    }

    public function validate()
    {
        if (strlen($this->value) > $this->max) {
            return $this->error;
        } else {
            return true;
        }
    }

}