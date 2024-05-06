<?php

namespace giuseppemuntoni\mvc\validation;


/**
 * Class RequiredRule
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\validation
 */
class RequiredRule extends Rule
{
    protected function defaultError(): string
    {
        return "The attribute $this->attributeCaption is required";
    }

    public function validate()
    {
        if (!$this->value) {
            return $this->error;
        } else {
            return true;
        }
    }
}