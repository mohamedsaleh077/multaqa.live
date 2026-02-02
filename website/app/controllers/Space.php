<?php

namespace controllers;

use core\Controller;
use models\SpaceModel;
use interfaces\CRUD;

class Space extends Controller
implements CRUD
{
    protected $spaceModel;
    protected $spaces = [];
    protected $space = [];

    public function __construct()
    {
        $this->spaceModel = new SpaceModel();
    }

    public function api($num, $for = ''){
        if (!filter_var(FILTER_VALIDATE_INT ,$num) && !($num > 0)){
            header('header: /ErrorPage/404');
        }
        switch($for){
            case '':
                $this->get($num);
                break;
            case 'all':
                $this->getAll($num);
                break;
            default:
                header('header: /ErrorPage/404');
        }
    }

    public function index($num, $for = ''){
        if (!filter_var(FILTER_VALIDATE_INT ,$num) && !($num > 0)){
            header('header: /ErrorPage/404');
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

    public function get($id)
    {
        $data = [
            'space' => $this->spaceModel->getSpace($id)[0],
            'posts' => $this->spaceModel->getSpacePosts($id),
            'users_count' => $this->spaceModel->getUsersCount($id)[0]
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getAll($page = 1)
    {
        $page = ($page - 1) * 50;
        $data = [
            'spaces' => $this->spaceModel->getSpaces($page),
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function create(){
        // TODO
    }

    public function update($id){
        // TODO
    }

    public function delete($id){
        // TODO
    }

}