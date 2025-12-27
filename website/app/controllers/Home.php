<?php
class Home extends Controller {

    // Index of the Home page (localhost/Home(/index))
    public function index() {
        $this->view('Home/index');
    }
}