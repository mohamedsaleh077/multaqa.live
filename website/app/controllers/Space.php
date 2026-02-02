<?php

namespace controllers;

use core\Controller;
use models\SpaceModel;

class Space extends Controller
{
    protected $spaceModel;
    protected $spaces = [];
    protected $space = [];
    protected $id;

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
                $this->fullOneSpaceJson($num);
                break;
            case 'all':
                $this->fullSpacesJson($num);
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
                $this->details($num);
                break;
            case 'all':
                $this->all($num);
                break;
            default:
                header('header: /ErrorPage/404');
        }
    }

    private function fullOneSpaceJson($index)
    {
        $this->id = $index;
        $data = [
            'space' => $this->spaceModel->getSpace($index)[0],
            'posts' => $this->spaceModel->getSpacePosts($index),
            'users_count' => $this->spaceModel->getUsersCount($index)[0]
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function fullSpacesJson($page = "")
    {
        $page = ($page - 1) * 50;
        $data = [
            'spaces' => $this->spaceModel->getSpaces($page),
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function details($index)
    {
        $this->id = $index;
        $this->view('Space/index', $this->space[0]);
    }

    private function all($index)
    {
        $this->spaces = $this->spaceModel->getSpaces($index);
        $this->view('Space/list', $this->spaces);
    }


}