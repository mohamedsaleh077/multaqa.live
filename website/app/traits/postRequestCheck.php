<?php

namespace traits;

trait postRequestCheck{
    public function postRequestCheck(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
            die("Unsupported request method");
        }
        return true;
    }
}