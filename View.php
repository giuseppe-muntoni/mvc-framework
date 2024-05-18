<?php

namespace giuseppemuntoni\mvc;


/**
 * Class View
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc
 */
class View
{
    public string $title = '';

    public function renderView($view, $params = [])
    {
        $viewContent = $this->viewContent($view, $params);
        $layoutContent = $this->layoutContent($params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent($params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }
    protected function viewContent($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}