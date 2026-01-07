<?php

namespace controllers;

class LastAction
{
    public static function setLastAction(){
        $_SESSION['last_action'] = time();
    }

    public function getWaiting()
    {
        if (!isset($_SESSION['last_action'])) {
            echo 0;
        } else {
            echo time() - $_SESSION['last_action'];
        }
    }

    public static function canProcess($interval){
        if(!isset($_SESSION['last_action'])) return true;
        if(time() - $_SESSION['last_action'] < $interval) return false;
        return true;
    }

}