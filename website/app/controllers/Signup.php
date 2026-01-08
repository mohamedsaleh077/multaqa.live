<?php

namespace controllers;
use core\Controller;
use core\traits\AuthHelper;

class Signup extends Controller {
    use AuthHelper;

    // Index of the Home page (localhost/Home(/index))
    public function index() {
        $this->view('Signup/index');
    }

    public function CreateAccount() {
        $this->inputCheck();
        $this->isUsernameTaken();
        $this->addUser();
        $this->setSessions();
        $this->redirect("signup/index", "");
    }
}