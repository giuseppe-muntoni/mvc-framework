<?php

namespace giuseppemuntoni\mvc\components\form;


use giuseppemuntoni\mvc\form\BaseField;

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
        return sprintf('<textarea class="form-control%s" name="%s">%s</textarea>',
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }
}