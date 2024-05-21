<?php

namespace giuseppemuntoni\mvc\validation;


use giuseppemuntoni\mvc\validation\Rule;

/**
 * Class PasswordRule
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\validation
 */
class PasswordRule extends Rule
{

    protected function defaultError(): string
    {
        return 'La password deve contenere almeno 8 caratteri di cui almeno una maiuscola, un numero e un carattere speciale';
    }

    public function validate()
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        if (!preg_match($pattern, $this->value)) {
            return $this->error;
        }

        return true;
    }
}