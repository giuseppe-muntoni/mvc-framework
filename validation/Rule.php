<?php

namespace app\core\validation;


/**
 * Class Rule
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package app\core\validation
 */
abstract class Rule
{
    protected string $error;
    protected $attribute;
    protected $attributeCaption;
    protected $value;

    public function __construct($attribute, $attributeCaption, $value, $error = null)
    {
        $this->attribute = $attribute;
        $this->attributeCaption = $attributeCaption;
        $this->value = $value;

        if (empty($customError)) {
            $this->error = $this->defaultError();
        } else {
            $this->error = $error;
        }
    }

    public function getAttribute()
    {
        return $this->attribute;
    }

    protected abstract function defaultError(): string;

    public abstract function validate();

}