<?php

namespace controllers;
use core\Controller;

Class ErrorPage extends Controller {
    public function index($error_code) {
        $this->view('Errors/index' , $error_code);
    }
}