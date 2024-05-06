<?php

namespace app\core\form;


use app\core\Model;

/**
 * Class Form
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package app\core\form
 */
class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        return '</form>';
    }
}