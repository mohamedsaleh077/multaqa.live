<?php

namespace controllers;

use core\Controller;
use models\SpaceModel;
use interfaces\iController;
use traits\CheckLogin;
use traits\postRequestCheck;
use core\Validation;

class Space extends Controller
implements iController
{
    use postRequestCheck;
    use CheckLogin;
    protected $spaceModel;
    protected $spaces = [];
    protected $space = [];

    public function __construct()
    {
        $this->spaceModel = new SpaceModel();
    }

    public function api(int $num, string $for = ''){
        if (!filter_var( $num, FILTER_VALIDATE_INT ) && !($num > 0)){
            header('location: /ErrorPage/404');
        }
        switch($for){
            case '':
                $this->get($num);
                break;
            case 'all':
                $this->getAll($num);
                break;
            default:
                header('location: /ErrorPage/404');
        }
    }

    public function index($num, $for = ''){
        if (!filter_var(FILTER_VALIDATE_INT ,$num) && !($num > 0)){
            header('location: /ErrorPage/404');
        }
        switch($for){
            case '':
                $this->view('Space/index');
                break;
            case 'all':
                $this->view('Space/list');
                break;
            default:
                header('header: /ErrorPage/404');
        }
    }

    public function get(int $id)
    {
        $data = [
            'space' => $this->spaceModel->getByID($id)[0],
            'posts' => $this->spaceModel->getSpacePosts($id),
            'users_count' => $this->spaceModel->getUsersCount($id)[0]
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getAll(int $page = 1)
    {
        $page = ($page - 1) * 50;
        $data = [
            'spaces' => $this->spaceModel->getAll($page),
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function create(){
        // TODO
        $this->postRequestCheck();
        $this->checkLogin();

        $category = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;
        $name = $_POST['name'] ?? null;
        $description = $_POST['description'] ?? null;
        $csrf = $_POST['CSRFToken'] ?? null;
        $captcha = $_POST['captcha'] ?? null;
        $avatar = $_POST['avatar'] ?? null;
        $cover = $_POST['cover'] ?? null;

        $errors = new Validation();
        $errors->checkCSRF($csrf);
        $errors->checkCaptchaPhase($captcha);
        $errors->checkMaxLength(["space_name" => [50, $name], "description" => [1000, $description]]);
        $errors->checkMinLength(["space_name" => [2, $name]]);

        if (!is_int($category)){
            $errors->addError("category_id", "Category must be an integer");
        }

        if (!$this->spaceModel->checkCategory($category)){
            $errors->addError("category", "Category doesn't exists");
        }

        if ($errors->getErrors()){
            $_SESSION['errors'] = $errors->getErrors();
            header('header: /Space/index/create');
            die();
        }

        $values = [
            'category_id' => $category,
            'name' => $name,
            'description' => $description ?? '',
            'cover_image' => $cover ?? '',
            'avatar' => $avatar ?? ''
        ];

        if (!$this->spaceModel->create($values)){
            $errors->addError("error", "There was an error creating the space
            , contact the administrator!");
            $_SESSION['errors'] = $errors->getErrors();
            header('header: /Space/index/create');
            die();
        }
    }

    public function update($id){
        // TODO
    }

    public function delete($id){
        // TODO
    }

}