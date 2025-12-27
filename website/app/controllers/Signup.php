<?php
class Signup extends Controller {

    // Index of the Home page (localhost/Home(/index))
    public function index() {
        $this->view('Signup/index');
    }
}