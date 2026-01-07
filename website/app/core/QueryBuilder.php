<?php
// My ORM feels so sigma
namespace Core;

use Core\Database;

class QueryBuilder
{
    protected $selectLine = "";
    protected $JoinLine = "";
    protected $whereLine = "";
    protected $orderLine = "";
    protected $insertLine = "";
    protected $updateLine = "";
    protected $deleteLine = "";

    /*
     * this would be just a stupid function!
     */
    public function selectAll($table){
        $this->selectLine = " SELECT * FROM {$table}; ";
    }

    /*
     * counting method
    */
    public function count($table, $column = '*'){
        $this->selectLine = " SELECT COUNT(*) AS count FROM {$table}; ";
    }

    /*
     * @param $table for table name
     * @param $columns [ alias => column name ]
     * @param $as AS whatever!
     */
    public function select($table, $columns, $tableAlias) :void
    {
        $selectedFields = [];
        foreach ($columns as $key => $value) {
            $selectedFields[] = is_int($key) ? $value : "$key AS $value";
        }

        $this->selectLine =  " SELECT " . implode(", ", $selectedFields) . " FROM " . $table . " " . $tableAlias . " ";
    }

    /*
     * @param $table table name
     * @param $columnOnPKTable for the right side
     * @param $columnOnFKTable for the left side
     * @param $type for Left, Right or inner!
     */
    public function join($table, $columnOnPKTable, $columnOnFKTable, $type = "") :void
    {
        $type = match($type) {
            "l" => " LEFT",
            "r" => " RIGHT",
            "i" => " INNER",
            default => "",
        };
        $this->JoinLine =  $type . " JOIN " . $table . " ON " . $columnOnFKTable . " = " . $columnOnPKTable;
    }

    /*
     * @param $columns is the right side
     * [ column1, $type => column2, column3 ]
     */
    public function where($columns) :void
    {
        $columnEqlPlaceholder = [];
        foreach ($columns as $type => $column) {
            if ($type === "l") {
                $columnEqlPlaceholder[] = "`$column` LIKE :$column";
            } else {
                $columnEqlPlaceholder[] = "`$column` = :$column";
            }
        }
        $this->whereLine = " WHERE " . implode(' AND ', $columnEqlPlaceholder);
    }

    /*
     * @param $column is the column at the end of order
     * @param $type, is the ASC or DESC
     */
    public function order($column, $type = "a") :void
    {
        $type = match($type) {
            "a" => "ASC",
            "d" => "DESC",
            default => ""
        };

        $this->orderLine =  " ORDER BY " . $column . " " . $type;
    }

    /*
     * $table is the table name
     * $value is the columns
     * result will be (column) VALUES (:column)
     * values will be inserted in another array for it, and will be handel in the execute method
     */
    public function insert($table, $columns) :void
    {
        $fields = "`" . implode("`, `", $columns) . "`";
        $placeholders = ":" . implode(", :", $columns);
        $this->insertLine = " INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $placeholders . ")";
    }

    /*
     * same as insert table literally
     */
    public function update($table, $columns) :void
    {
        // SQL: SET col1 = :col1, col2 = :col2
        $columnEqlPlaceholder = [];
        foreach ($columns as $column) {
            $columnEqlPlaceholder[] = "`$column` = :$column";
        }
        $this->updateLine = " UPDATE " . $table . " SET " . implode(', ', $columnEqlPlaceholder);
    }

    public function delete($table) :void
    {
        $this->deleteLine = " DELETE FROM " . $table . " ";
    }

    protected function Build(): string
    {
        $sql = "";
        if($this->selectLine){
            $sql =  $this->selectLine . $this->JoinLine . $this->whereLine . $this->orderLine . " ;";
        }

        if ($this->insertLine) {
            $sql = $this->insertLine . " ;";
        }

        if ($this->updateLine) {
            $sql = $this->updateLine . $this->whereLine . " ;";
        }

        if ($this->deleteLine) {
            $sql = $this->deleteLine . " ;";
        }

        return $sql;
    }

    public function execute(array $params = [], $all = false)
    {
        $sql = $this->Build();
        $result = $all ? Database::fetchAll($sql, $params) : Database::fetchOne($sql, $params);

        // تصفير كل الـ properties عشان الاستعلام اللي جاي
        $this->selectLine = $this->JoinLine = $this->whereLine = $this->orderLine = "";
        $this->insertLine = $this->updateLine = $this->deleteLine = "";

        return $result;
    }
}