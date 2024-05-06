<?php

namespace giuseppemuntoni\mvc\middlewares;


/**
 * Class BaseMiddleware
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\middlewares
 */
abstract class BaseMiddleware
{
    abstract public function execute();
}