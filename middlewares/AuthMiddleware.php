<?php

namespace giuseppemuntoni\mvc\middlewares;


use giuseppemuntoni\mvc\Application;
use giuseppemuntoni\mvc\exception\ForbiddenException;
use giuseppemuntoni\mvc\middlewares\BaseMiddleware;

/**
 * Class AuthMiddleware
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\middlewares
 */
class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];

    /**
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest() ) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}