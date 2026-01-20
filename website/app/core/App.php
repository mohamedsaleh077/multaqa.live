<?php

namespace core;

class App
{
    protected $controllerName = 'controllers\\ErrorPage';
    protected $method = 'index';
    protected $params = ['404'];
    protected $url;
    protected $controller;

    public function __construct()
    {
        // Parse url into readable string
        $this->parseUrl();

        $this->url[0] = ucfirst(strtolower( $this->url[0] ?? '' ));

        $this->setController();
        $this->setMethod();
        $this->setParams();

        $this->controller = new $this->controllerName();
        // Create a new instance of the controller
        if(!class_exists($this->controllerName) || !is_callable([$this->controller, $this->method])) {
            $this->setPageToErrorPage();
        }

        call_user_func_array([($this->controller), $this->method], $this->params);
    }

    // Parse url  into useable array
    private function parseUrl()
    {
        if (!isset($_GET['url'])){
            $this->url = [];
            return;
        }
        $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
        $url = preg_replace('/[^a-zA-Z0-9\/]/', '', $url);
        $this->url = explode('/', $url);
    }

    private function setController()
    {
        if (empty($this->url[0])) {
            $this->controllerName = 'controllers\\Home';
            return;
        }

        $controller_file = $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $this->url[0] . '.php';
        if (file_exists($controller_file)) {
            $this->controllerName = 'controllers\\' . $this->url[0];
            unset($this->url[0]);
        }
    }

    private function setMethod()
    {
        if (!isset($this->url[1])) {
            return;
        }

        if (!method_exists($this->controllerName, $this->url[1])) {
            $this->controllerName = 'controllers\\ErrorPage';
            return;
        }

        $this->method = $this->url[1];
        unset($this->url[1]);
    }

    private function setParams()
    {
        if($this->controllerName === 'controllers\\ErrorPage'){
            return;
        }

        $this->params = isset($this->url[2]) ? array_values($this->url) : [];
    }

    private function setPageToErrorPage()
    {
        $this->controller = new \controllers\ErrorPage();
        $this->method = 'index';
        $this->params = ['404'];
    }
}