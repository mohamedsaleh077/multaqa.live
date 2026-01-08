<?php

namespace controllers;
use core\Controller;
use core\traits\AuthHelper;

class Login extends Controller
{
    use AuthHelper;
    public function index() {
        $this->view('Home/index');
    }
    public function validate() {
        $this->inputCheck();
        $this->isUsernameExist();
        $this->checkPassword();
        $this->setSessions();
        $this->redirect("", "");
    }
}