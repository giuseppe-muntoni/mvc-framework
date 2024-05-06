<?php

namespace giuseppemuntoni\mvc\exception;


/**
 * Class ForbiddenException
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\exception
 */
class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to access this page.';
    protected $code = 403;
}