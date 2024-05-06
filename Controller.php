<?php

namespace giuseppemuntoni\mvc;


use giuseppemuntoni\mvc\middlewares\BaseMiddleware;

/**
 * Class Controller
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc
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