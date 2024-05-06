<?php

namespace giuseppemuntoni\mvc\validation;


use giuseppemuntoni\mvc\validation\Rule;

/**
 * Class MatchRule
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\validation
 */
class MatchRule extends Rule
{

    private string $matchAttributeCaption;
    private $matchValue;

    public function __construct($attribute, $attributeCaption, $value, $matchAttributeCaption, $matchValue, $error = null) {
        $this->matchAttributeCaption = $matchAttributeCaption;
        $this->matchValue = $matchValue;
        parent::__construct($attribute, $attributeCaption, $value, $error);
    }

    protected function defaultError(): string
    {
        return "The attribute {$this->attributeCaption} does not match the attribute {$this->matchAttributeCaption}";
    }

    public function validate()
    {
        if ($this->matchValue !== $this->value) {
            return $this->error;
        } else {
            return true;
        }
    }
}