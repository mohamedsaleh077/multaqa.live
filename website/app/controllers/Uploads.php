<?php

namespace controllers;
use core\Controller;

class Uploads extends Controller {

    // Index of the Home page (localhost/Home(/index))
    public function jpeg($image) {
        if (!isset($image)){
            $this->ErrorForward();
        }
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/app/uploads/" . $image . '.jpg';
        $im = imagecreatefromjpeg( $filename );
        if ($im === false){
            var_dump($im);
        }

        header('Content-Type: image/jpeg');
        imagejpeg($im);
    }

    public function png($image) {
        if (!isset($image)){
            $this->ErrorForward();
        }
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/app/uploads/" . $image . '.png';
        $im = imagecreatefrompng( $filename );
        if ($im === false){
            $this->ErrorForward();
        }

        header('Content-Type: image/png');
        imagepng($im);
    }

}