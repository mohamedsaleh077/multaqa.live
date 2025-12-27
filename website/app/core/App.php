<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        // Parse url into readable string
        $url = $this->parseUrl();
        $controller_file = $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $url[0] . '.php';

        // Get controller
        if (file_exists( $controller_file )) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // Get method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Get parameters
        $this->params = $url ? array_values($url) : [];

        // check if the page not exists
        if (isset($url[0]) && !file_exists( $controller_file )) {
            $this->controller = 'ErrorPage';
            $this->method = 'index';
            $this->params = ['404'];
        }

        // If controller (url[0]) doesn't exist it will use 'Home' automatically
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $this->controller . '.php';

        // Create a new instance of the controller
        $this->controller = new $this->controller;

        // Calls the specific controller, method and pass the parameters to them
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Parse url  into useable array
    private function parseUrl() {
        if (isset($_GET['url']))
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    }
}