<?php

namespace giuseppemuntoni\mvc\components\form;


use giuseppemuntoni\mvc\Model;

/**
 * Class Field
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\components\form
 */
class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_NUMBER = 'number';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_HIDDEN = 'hidden';
    const TYPE_FILE = 'file';

    private string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function passwordField() {
        $this->type=self::TYPE_PASSWORD;
        return $this;
    }

    public function fileField()
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }

    public function numberField()
    {
        $this->type = self::TYPE_NUMBER;
        return $this;
    }

    public function hiddenField() {
        $this->type = self::TYPE_HIDDEN;
        return $this;
    }

    public function renderInput()
    {
        return sprintf('<input type="%s" name="%s" value="%s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }

    public function __toString()
    {
        if ($this->type !== self::TYPE_HIDDEN)
            return parent::__toString();

        return $this->renderInput();
    }
}