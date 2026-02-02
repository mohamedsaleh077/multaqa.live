<?php

namespace controllers;

use core\Controller;
use core\QueryBuilder;
use models\SpaceModel;

class Space extends Controller
{
    protected $SQL;
    protected $spaces = [];
    protected $space = [];
    protected $id;

    public function __construct()
    {
        $this->SQL = new QueryBuilder();
    }

    use SpaceModel;

    public function details($index)
    {
        $this->id = $index;
        $this->view('Space/index', $this->space[0]);
    }

    public function all($index)
    {
        $this->spaces = $this->getSpaces($index);
        $this->view('Space/list', $this->spaces);
    }

    public function fullOneSpaceJson($index)
    {
        if (!$this->checkNumParam($index)) {
            $this->ErrorForward();
        };
        $this->id = $index;
        $data = [
            'space' => $this->getSpace()[0],
            'posts' => $this->getSpacePosts(),
            'users_count' => $this->getUsersCount()[0]
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function fullSpacesJson($page = "")
    {
        $page = ($page - 1) * 50;
        $data = [
            'spaces' => $this->getSpaces($page),
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}