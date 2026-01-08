<?php

namespace controllers;
use core\Controller;
use core\QueryBuilder;
class Space extends Controller {
    protected $SQL;
    protected $spaces = [];
    protected $space = [];
    protected $id;
    public function __construct(){
        $this->SQL = new QueryBuilder();
    }
    private function getSpaces()
    {
        return $this->SQL->selectAll("spaces")->execute();
    }

    private function getSpace(){
        return $this->SQL->select("spaces", ["*"])->where([["id", "="]])->build()->execute([$this->id]);
    }
    public function details($index) {
        if(is_numeric($index)) {
            $this->id = $index;
            $this->space = $this->getSpace();
        } else {
            $this->space = null;
        }
        if(!$this->space[0]) {
            header('Location: /ErrorPage/404');
            die();
        }
        $this->view('Space/index', $this->space[0]);
    }

    public function all(){
        $this->view('Space/list', $this->spaces);
    }
}