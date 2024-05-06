<?php

namespace giuseppemuntoni\mvc;


use giuseppemuntoni\mvc\exception\NotFoundException;

/**
 * Class Router
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc
 */
class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * @throws NotFoundException
     */
    public function resolve()
    {
        $method = $this->request->method();
        $path = $this->request->path();
        $callback = $this->routes[$method][$path] ?? false;
        $view = Application::$app->view;

        if ($callback === false) {
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return $view->renderView($callback);
        }

        if (is_array($callback)) {
            /** @var Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

         return call_user_func($callback, $this->request);
    }
}