<?php

namespace giuseppemuntoni\mvc\form;


use giuseppemuntoni\mvc\Model;

/**
 * Class Form
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\form
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