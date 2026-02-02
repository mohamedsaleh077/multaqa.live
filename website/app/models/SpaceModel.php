<?php

namespace models;
use core\QueryBuilder;
class SpaceModel
{
    protected $SQL;
    public function __construct(){
        $this->SQL = new QueryBuilder();
    }
    public function getSpaces($page)
    {
        return $this->SQL->selectAll("spaces")->limit(50, $page)->build()->execute([], true);
    }

    public function getSpace($id){
        return $this->SQL->select("spaces", ["*"])->where([["id", "="]])->build()->execute([$id]);
    }

    public function getSpacePosts($id){
        return $this->SQL
            ->select("posts", ['*'])
            ->join("spaces", "spaces.id" ,"posts.space_id")
            ->join("users", "users.id" ,"posts.user_id")
            ->where([["space_id", "="]])
            ->build()->execute([$id]);
    }

    public function getUsersCount($id){
        return $this->SQL
            ->count("feed", "user_id")
            ->where([["space_id", "="]])
            ->build()->execute([$id]);
    }
}