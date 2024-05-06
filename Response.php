<?php

namespace giuseppemuntoni\mvc;


/**
 * Class Response
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc
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