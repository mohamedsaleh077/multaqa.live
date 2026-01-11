<?php

namespace core\traits;

use core\Database;
use core\QueryBuilder;

use core\Controller;

trait AuthHelper
{
    private $errors;
    protected $user;
    private $captcha;
    private $csrf;
    protected $username;
    private $password;
    private $SQL;

    protected function inputCheck()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die('Method not allowed');
        $this->errors = new \core\Validation();

        $this->username = $_POST['username'];
        $this->password = $_POST['password'];
        $this->csrf = $_POST['csrf'];
        $this->captcha = $_POST['captcha'];

        $this->errors->checkRequired(
            [
                "username" => $this->username,
                "password" => $this->password,
                "csrf" => $this->csrf,
                "captcha" => $this->captcha
            ]);
        $this->errors->checkCSRF($this->csrf);
        $this->errors->checkCaptchaPhase($this->captcha);
        $this->errors->checkMaxLength(["username" => [50, $this->username], "password" => [50, $this->password]]);
        $this->errors->checkMinLength(["username" => [3, $this->username], "password" => [8, $this->password]]);

        // I wont check for password strongness, because it's not my job. since there is a JS unit for that!! so if
        // user bypassed it to use a week password so, let him khs.

    }

    private function getUser()
    {
        if (empty($this->errors->getErrors())) {
            $this->SQL = new QueryBuilder();
            $this->user = $this->SQL->select("users", ["id", "username", "password_hash", "profile_picture" ,"created_at"])->where([["username", "="]])->build()->execute([$this->username]);
        }
        return $this->user;
    }

    protected function addUser()
    {
        if (!empty($this->errors->getErrors())) return;
        $options = [
            'cost' => 12
        ];
        $hashedPwd = password_hash($this->password, PASSWORD_DEFAULT, $options);

        $this->SQL->insert("users", ["username", "password_hash"])->Build()->execute([$this->username, $hashedPwd]);
    }

    protected function isUsernameTaken()
    {
        if ($this->getUser()[0]) $this->errors->addError("user_taken");
    }

    protected function isUsernameExist()
    {
        if (!$this->getUser()[0]) $this->errors->addError("user_not_found");
    }

    protected function checkPassword()
    {
        if (!password_verify($this->password, $this->user[0]['password_hash'])) {
            $this->errors->addError("wrong_password");
        }
    }

    protected function redirect($whenError = '', $whenDone = '')
    {
        if (!empty($this->errors->getErrors())) {
            $_SESSION['user_id'] = null;
            $_SESSION['username'] = null;
            $_SESSION['errors'] = $this->errors->getErrors();
            header('Location: /' . $whenError);
        } else {
            header('Location: /' . $whenDone);
        }
        die();
    }

    protected function getSpaces()
    {
        $this->SQL->select("feed", ['space_id'])->join("spaces", "spaces.id" ,"feed.space_id")->where([["user_id", "="]]);
        return $this->SQL->build()->execute([$_SESSION['user_id']]);
    }

    protected function setSessions()
    {
        if (!empty($this->errors->getErrors())) return;
        $_SESSION['user_id'] = ($this->user[0]) ? $this->user[0]['id'] : Database::lastInsertId();
        $_SESSION['username'] = $this->user[0]['username'] ?? $this->username;
        $_SESSION['created_since'] = (isset($this->user[0]['created_at']))
            ? Controller::dateDiff($this->user[0]['created_at'])
            : ["d"=>0, "m"=>0, "y"=>0];
        $_SESSION['pfp'] = $this->user[0]['profile_picture'] ?? '/assets/default_pfp.svg';
        $_SESSION['bio'] = $this->user[0]['bio'] ?? '';
        $_SESSION['userSpaces'] = $this->getSpaces();
    }

}