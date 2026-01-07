<?php
// My ORM feels so sigma
namespace Core;

use Error;

class QueryBuilder
{
    protected $selectLine = "";
    protected $JoinLine = "";
    protected $whereLine = "";
    protected $orderLine = "";
    protected $insertLine = "";
    protected $updateLine = "";
    protected $deleteLine = "";
    protected $querysArray = [];

    /*
     * this would be just a stupid function!
     */
    public function selectAll($table)
    {
        $this->selectLine = " SELECT * FROM {$table}; ";
        return $this;
    }

    /*
     * counting method
    */
    public function count($table, $column = '*')
    {
        $this->selectLine = " SELECT COUNT({$column}) AS count FROM {$table}; ";
        return $this;
    }

    /*
     * @param $table for table name
     * @param $columns [ alias => column name ]
     * @param $as AS whatever!
     */
    public function select($table, $columns, $tableAlias = "")
    {
        $selectedFields = [];
        foreach ($columns as $key => $value) {
            $selectedFields[] = is_int($key) ? $value : "$key AS $value";
        }
        $tableAlias = ($tableAlias) ? " AS {$tableAlias}" : "";
        $this->selectLine = " SELECT " . implode(", ", $selectedFields) . " FROM " . $table . " " . $tableAlias . " ";
        return $this;
    }

    /*
     * @param $table table name
     * @param $columnOnPKTable for the right side
     * @param $columnOnFKTable for the left side
     * @param $type for Left, Right or inner!
     */
    public function join($table, $columnOnPKTable, $columnOnFKTable, $type = "")
    {
        $type = match ($type) {
            "left" => " LEFT",
            "right" => " RIGHT",
            "inner" => " INNER",
            default => "",
        };
        $this->JoinLine = $type . " JOIN " . $table . " ON " . $columnOnFKTable . " = " . $columnOnPKTable;
        return $this;
    }

    /*
     * where protection, to kill the connector if the developer inserted it by mistake
     */
    protected function whereConnectorProtection($arr) :array
    {
        $index = count($arr) - 1;
        if(isset($arr[$index][2])) $arr[$index][2] = "";
        return $arr;
    }

    /*
     * I need to reduce the repeation
     */
    protected function whereBuilder($arr) :string
    {
        $placeholders = " :" . $arr[0];
        $arr[1] = strtoupper($arr[1]); // if operator is LIKE
        $arr[2] = $arr[2] ? strtoupper($arr[2]) : "";
        return " {$arr[0]} {$arr[1]} {$placeholders} {$arr[2]} ";
    }

    /*
     * @param $columns is the right side
     * [ [column, "=", "or"], [column, "!=", "and"], [column, "like"], [[column, "=", "and"], [column, "LIKE"]], [column, "="] ]
     */
    public function where($columns)
    {
        $columnEqlPlaceholder = [];
        $lastIndex = count($columns) - 1;
        if(is_array($columns[$lastIndex][0])) {
            $columns = $this->whereConnectorProtection($columns);
        }
        for($i = 0; $i < count($columns); $i++) {
            $arr = $columns[$i];
            if (is_array($arr[0])) {
                $arr = $this->whereConnectorProtection($arr);
                $columnEqlPlaceholder[] .= " ( ";
                foreach ($arr as $subArr) {
                    $columnEqlPlaceholder[] .= $this->whereBuilder($subArr);
                }
                $columnEqlPlaceholder[] .= " ) ";
            } else {
                $columnEqlPlaceholder[] .= $this->whereBuilder($arr); ;
            }
        }
        $this->whereLine = " WHERE " . implode(' ', $columnEqlPlaceholder);
        return $this;
    }

    /*
     * @param $column is the column at the end of order
     * @param $type, is the ASC or DESC
     */
    public function order($column, $type = "a")
    {
        $type = match ($type) {
            "a" => "ASC",
            "d" => "DESC",
            default => ""
        };

        $this->orderLine = " ORDER BY " . $column . " " . $type;

        return $this;
    }

    /*
     * $table is the table name
     * $value is the columns
     * result will be (column) VALUES (:column)
     * values will be inserted in another array for it, and will be handel in the execute method
     */
    public function insert($table, $columns)
    {
        $fields = "`" . implode("`, `", $columns) . "`";
        $placeholders = ":" . implode(", :", $columns);
        $this->insertLine = " INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $placeholders . ")";

        return $this;
    }

    /*
     * same as insert table literally
     */
    public function update($table, $columns)
    {
        // SQL: SET col1 = :col1, col2 = :col2
        $columnEqlPlaceholder = [];
        foreach ($columns as $column) {
            $columnEqlPlaceholder[] = "`$column` = :$column";
        }
        $this->updateLine = " UPDATE " . $table . " SET " . implode(', ', $columnEqlPlaceholder);

        return $this;
    }

    public function delete($table)
    {
        $this->deleteLine = " DELETE FROM " . $table . " ";
        return $this;
    }

    public function Build() :void
    {
        if ($this->selectLine) {
            $this->querysArray[] = $this->selectLine . $this->JoinLine . $this->whereLine . $this->orderLine . " ;";
        }

        if ($this->insertLine) {
            $this->querysArray[] =  $this->insertLine . " ;";
        }

        if ($this->updateLine && $this->whereLine) {
            $this->querysArray[] =  $this->updateLine . $this->whereLine . " ;";
        }

        if ($this->deleteLine && $this->whereLine) {
            $this->querysArray[] =  $this->deleteLine . $this->whereLine . " ;";
        }

        $this->selectLine = $this->JoinLine = $this->whereLine = $this->orderLine = "";
        $this->insertLine = $this->updateLine = $this->deleteLine = "";
    }

    public function execute(array $params = [], $all = false): array
    {
        $result = [];
        foreach($this->querysArray as $sql) {
            try {
                $result[] = $all ? Database::fetchAll($sql, $params) : Database::fetchOne($sql, $params);
            }catch( \PDOException $Exception ) {
                // PHP Fatal Error. Second Argument Has To Be An Integer, But PDOException::getCode Returns A
                // String.
                throw new error( "error with the query: " . $sql . $Exception->getMessage( ) , $Exception->getCode( ));
            }
        }
        return $result;
    }
}



/*
 * How to use?
 * 1. you need Database Class with it
 * 2. you will build query using the chain potatos
 * ex:
 * select(..)->insert(...)->build()->selectAll(...)->build()->execute();
 * you can use one select, insert, delete, update before every build, if you used two selects, it will be overridden
 * select, selectAll, count, all of them are select
 * build() to save your query.
 *
 * What params would you love?
 * selectAll( tablename )
 * count( tablename, column = *)
 * select( TableName , [col1, col2, col3], alias = "")
 *
 * join( tablename , PKcolumn, FKcolumn, "left" "right" "inner" "")
 * where([
 *          [column, "=", "or"], [column, "!=", "and"], [column, "like"],
 *          [
 *              [column, "=", "and"],
 *              [column, "LIKE"]
 *          ] for grouping
 *          , [column, "="] ]);
 * order(column, $type = "a for ASC and d for DESC, a is default")
 *
 * insert(tablename, array of columns) the function will make columnname VALUES :columnname
 *
 * update(tablename, columns) must have where()
 * delete(table name) must have where()
 *
 * update and delete without where() will never run
 */