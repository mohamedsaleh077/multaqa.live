<?php

namespace models;
use core\QueryBuilder;
use core\Database;
use interfaces\iModel;

class SpaceModel
implements iModel
{
    protected $SQL;
    public function __construct(){
        $this->SQL = new QueryBuilder();
    }
    public function getAll(int $page)
    {
        return $this->SQL->selectAll("spaces")->limit(50, $page)->build()->execute([], true);
    }

    public function getByID($id){
        return $this->SQL->select("spaces", ["*"])->where([["id", "="]])->build()->execute([$id]);
    }

    public function getCount(){
        // TODO
    }

    public function getSpacePosts($id){
//        $cols = [
//            "users.id" => "user_id",
//            "users.username" => "username",
//            "users.profile_picture" => "profile_picture",
//            "posts.id" => "post_id",
//            "posts.title" => "title",
//            "posts.body" => "body",
//            "posts.created_at" => "created_at",
//            "uploads.entity_type_id" => "entity_type_id",
//            "GROUP_CONCAT(DISTINCT uploads.filename ORDER BY uploads.created_at SEPARATOR ',')" => "files"
//        ];
//        return $this->SQL
//            ->select("posts", $cols)
//            ->join("spaces", "spaces.id" ,"posts.space_id")
//            ->join("users", "users.id" ,"posts.user_id")
//            ->join("uploads", "uploads.id" ,"posts.id")
//            ->where([["space_id", "=", "AND"], ["entity_type_id", "="]])
//            ->groupBy(["posts.id"])
//            ->build()->execute([$id, 1]);
        $query = "SELECT 
                    posts.id AS post_id,
                    posts.title AS post_title,
                    posts.body AS post_body,
                    posts.score AS post_score,
                    posts.created_at AS created_at,
                    
                    users.id AS user_id,
                    users.username AS username,
                    users.profile_picture AS profile_picture,
                    
                    COALESCE(
                        JSON_ARRAYAGG(uploads.filename),
                        JSON_ARRAY()
                    ) AS files
                
                FROM posts
                
                LEFT JOIN users ON posts.user_id = users.id
                LEFT JOIN uploads 
                    ON uploads.ref_id = posts.id
                   AND uploads.entity_type_id = 1
                
                WHERE posts.space_id = :space_id
                
                GROUP BY posts.id;";
        return Database::fetchAll($query, [$id]);
    }

    public function getUsersCount($id){
        return $this->SQL
            ->count("feed", "user_id")
            ->where([["space_id", "="]])
            ->build()->execute([$id]);
    }

    public function checkCategory($id){
        return $this->SQL
            ->select("categories", ["*"])
            ->where([["id", "="]])
            ->build()->execute([$id]);
    }

    /*
     * @params $values = ['category_id' => , 'name' => , 'description' => , 'cover_image' => , 'avatar' =>]
     */
    public function create(array $values){
        $createResult =  $this->SQL
            ->insert("spaces", ['category_id', 'name', 'description', 'cover_image', 'avatar'])
            ->build()->execute($values);
        $lastInsertId = Database::lastInsertId();
        $settingOwner = $this->SQL
            ->insert("owners", ["space_id", "owner_id"])
            ->build()->execute([$lastInsertId, $_SESSION['user_id']]);

        return $createResult + $settingOwner;
    }

    public function update(int $id, array $values){
        // TODO
    }

    public function delete(int $id){
        // TODO
    }


}