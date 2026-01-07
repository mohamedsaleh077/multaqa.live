<?php
namespace Controllers;
use Core\Controller;

use Gregwar\Captcha\CaptchaBuilder;

class Captcha extends Controller
{

    private $builder;
    public function __construct()
    {
        $this->builder = new CaptchaBuilder;
        $this->builder->build();
        $_SESSION['captchaPhase'] = $this->builder->getPhrase();
    }
    public function img()
    {
        header('Content-type: image/jpeg');
        $this->builder->output();
    }
}