<?php

namespace app\core;


use app\core\middlewares\BaseMiddleware;

/**
 * Class Controller
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package app\core
 */
class Controller
{

    public string $layout = 'main';
    public string $action = '';

    /**
     * @var BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    protected function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}