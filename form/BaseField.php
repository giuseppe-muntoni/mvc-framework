<?php

namespace giuseppemuntoni\mvc\form;


use giuseppemuntoni\mvc\Model;

/**
 * Class BaseField
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\form
 */
abstract class BaseField
{
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('<div class="form-group">
                <label>%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }

    abstract public function renderInput();
}