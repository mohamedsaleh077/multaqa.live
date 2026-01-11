<?php

namespace models;

trait SpaceModel
{
    private function getSpaces($page)
    {
        return $this->SQL->selectAll("spaces")->limit(50, $page)->build()->execute([], true);
    }

    private function getSpace(){
        return $this->SQL->select("spaces", ["*"])->where([["id", "="]])->build()->execute([$this->id]);
    }

    private function getSpacePosts(){
        return $this->SQL
            ->select("posts", ['*'])
            ->join("spaces", "spaces.id" ,"posts.space_id")
            ->join("users", "users.id" ,"posts.user_id")
            ->where([["space_id", "="]])
            ->build()->execute([$this->id]);
    }

    private function getUsersCount(){
        return $this->SQL
            ->count("feed", "user_id")
            ->where([["space_id", "="]])
            ->build()->execute([$this->id]);
    }
}