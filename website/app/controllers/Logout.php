<?php

namespace controllers;
use core\Controller;

class Logout extends Controller
{
    public function index() {
        session_destroy();
        header("Location: /");
        die();
    }
}