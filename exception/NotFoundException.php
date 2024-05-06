<?php

namespace giuseppemuntoni\mvc\exception;


/**
 * Class NotFoundException
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\exception
 */
class NotFoundException extends \Exception
{
    protected $message = 'Page not found';
    protected $code = 404;

}