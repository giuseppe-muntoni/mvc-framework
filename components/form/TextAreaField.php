<?php

namespace giuseppemuntoni\mvc\components\form;


use giuseppemuntoni\mvc\components\form\BaseField;

/**
 * Class TextAreaField
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\components\form
 */
class TextAreaField extends BaseField
{
    public function renderInput()
    {
        return sprintf('<textarea name="%s">%s</textarea>',
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }
}