<?php

namespace app\core\exception;


/**
 * Class ForbiddenException
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package app\core\exception
 */
class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to access this page.';
    protected $code = 403;
}