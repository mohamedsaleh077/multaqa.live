<?php

namespace Core;

class Validation
{
    protected $errors = [];
    public function addError($errorId) {
        $this->errors[] = $errorId;
    }

    public function getErrors() {
        return $this->errors;
    }

    /*
     * $values = [ "field name" => [255 , "user input"] ]
     */
    public function checkMaxLength(array $values) {
        foreach($values as $key => $value) {
            if(mb_strlen($value[1]) >= $value[0]) $this->errors[] = "max_" . $key . "_" . $value[0];
        }
    }

    public function checkMinLength(array $values) {
        foreach($values as $key => $value) {
            if(mb_strlen($value[1]) <= $value[0]) $this->errors[] = "min_" . $key . "_" . $value[0];
        }
    }

    public function checkEmail($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $this->errors[] = "email";
    }

    /*
     * $values = [ "username" => "TheInput"]
     */
    public function checkRequired($values) {
        foreach($values as $key => $value) {
            if (empty($value)) $this->errors[] = "no_" . $key;
        }
    }

    public function checkCSRF($userToken) {
        if ($userToken !==  $_SESSION["CSRF_TOKEN"]) $this->errors[] = "csrf_err";
    }

    public function checkCaptchaPhase($userPhase) {
        if ($userPhase !==  $_SESSION['captchaPhase'] ) $this->errors[] = "captcha_err";
    }

}