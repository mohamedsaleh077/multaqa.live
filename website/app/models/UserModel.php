<?php

namespace models;

use core\Model;

class UserModel extends Model
{
    public function getAll($page = 0)
    {
        return $this->SQL->selectAll("spaces")->limit(50, $page)->build()->execute([], true);
    }

    public function getOne($id)
    {
        $cols = [
            "categories.name" => "category_name",
            "spaces.name" => "space_name",
            "spaces.avatar" => "space_icon",
            "spaces.cover_image" => "space_cover",
            "spaces.description" => "space_description",
            "spaces.id" => "space_id",
            "spaces.created_at" => "created_at",
        ];
        $params = [
          "space_id" => $this->id
        ];
        return $this->SQL
            ->select("spaces", $cols)
            ->join("categories", "categories.id", "spaces.category_id")
            ->where([["spaces.id", "=", "", "space_id"]])
            ->build()->execute($params);
    }

    public function getCount()
    {
        // TODO: Implement getCount() method.
    }
}