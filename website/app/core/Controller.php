<?php

namespace core;
use DateTime;

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

    public static function canProcess($interval){
        if(!isset($_SESSION['last_action'])) return true;
        if(time() - $_SESSION['last_action'] < $interval) return false;
        return true;
    }

    public static function setLastAction(){
        $_SESSION['last_action'] = time();
    }

    public static function dateDiff($past)
    {
        $now = new DateTime();
        $past = new DateTime($past);

        return $now->diff($past);
    }

    protected function ErrorForward(){
        header("Location: /ErrorPage/index/404");
        die();
    }
}