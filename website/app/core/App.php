<?php

namespace core;

class App
{
    protected $controller = 'controllers\\ErrorPage';
    protected $method = 'index';
    protected $params = ['404'];
    protected $url;

    private function setController()
    {
        $controller_file = $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $this->url[0] . '.php';
        if (empty($this->url[0])) {
            $this->controller = 'controllers\\Home';
        }
        if (file_exists($controller_file)) {
            $this->controller = 'controllers\\' . ucfirst($this->url[0]);
            unset($this->url[0]);
        }
        return $this;
    }

    private function setMethod()
    {
        if (isset($this->url[1])) {
            if (method_exists($this->controller, $this->url[1])) {
                $this->method = $this->url[1];
                unset($this->url[1]);
            } else {
                $this->controller = 'controllers\\ErrorPage';
            }
        }
        return $this;
    }

    private function setParams()
    {
        if($this->controller !== 'controllers\\ErrorPage'){
            $this->params = isset($this->url[2]) ? array_values($this->url) : [];
        }
        return $this;
    }

    public function __construct()
    {
        // Parse url into readable string
        $this->url = $this->parseUrl();

        $this->url[0] = ucfirst(strtolower( $this->url[0] ));

        $this->setController()->setMethod()->setParams();

        // Create a new instance of the controller
        $this->controller = new $this->controller;

        // Calls the specific controller, method and pass the parameters to them
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Parse url  into useable array
    private function parseUrl()
    {
        if (isset($_GET['url']))
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    }
}