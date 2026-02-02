<?php

namespace traits;

trait CheckLogin{
    public function checkLogin(){
        if (!$_SESSION['user']){
            return false;
        }
        return true;
    }

    public function checkAdmin(){
        if ($_SESSION['role'] !== 'admin'){
            return false;
        }
        return true;
    }
}