<?php

namespace app\core;


/**
 * Class Response
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package app\core
 */
class Response
{
    public function setStatusCode(int $code = 200)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header("Location: $url");
    }

}