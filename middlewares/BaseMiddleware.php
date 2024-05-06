<?php

namespace app\core\middlewares;


/**
 * Class BaseMiddleware
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package app\core\middlewares
 */
abstract class BaseMiddleware
{
    abstract public function execute();
}