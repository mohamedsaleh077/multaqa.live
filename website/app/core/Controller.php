<?php

class Controller {

    // Create a new instance of a model
    protected function model($model) {
        require_once  $_SERVER['DOCUMENT_ROOT'] . '/app/models/' . $model . '.php';
        return new $model();
    }

    // Load data to a specific views
    protected function view($view, $data = []) {
        require_once  $_SERVER['DOCUMENT_ROOT'] . '/app/views/' . $view . '.php';
    }
}