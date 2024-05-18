<?php

namespace giuseppemuntoni\mvc;


use giuseppemuntoni\mvc\db\Database;
use giuseppemuntoni\mvc\db\DbModel;

/**
 * Class Application
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc
 */
class Application
{
    public static string $USER_CLASS_KEY = 'user';
    public static string $ROOT_DIR;

    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public Database $db;
    public Session $session;
    public ?DbModel $user;
    public View $view;
    public array $config;


    public function __construct($root_dir, array $config) {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->controller = new Controller();
        if (key_exists('db', $config)) {
            $this->db = new Database($config['db']);
        }
        $this->config = $config;
        $this->session = new Session();
        $this->user = null;
        $this->view = new View();
        $this::$app = $this;
        $this::$ROOT_DIR = $root_dir;

        $userId = $this->session->get('user');
        if ($userId) {
            $userClass = $config['app'][self::$USER_CLASS_KEY];
            $key = $userClass::primaryKey();
            $this->user = $userClass::findOne([$key => $userId]);
        }
    }

    public function run() {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', ['error' => $e]);
        }
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }

    public function login(DbModel $user): bool
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set("user", $primaryValue);

        return true;
    }

    public function logout() {
        $this->session->remove("user");
        $this->user = null;
    }
}