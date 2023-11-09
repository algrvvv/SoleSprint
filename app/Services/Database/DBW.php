<?php

namespace App\Services\Database;

use App\Services\Helpers\Helpers;

class DBW
{
    private string $DB_HOST = 'localhost';
    private string $DB_PORT = '3306';
    private string $DB_NAME = "solesprint";
    private string $DB_USERNAME = "root";
    private string $DB_PASSWORD = "";
    private $connection;
    private $query;

    public function __construct()
    {
        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $this->connection = mysqli_connect(
                $this->DB_HOST,
                $this->DB_USERNAME,
                $this->DB_PASSWORD,
                $this->DB_NAME
            );
        } catch (\Exception $e) {
            die("ошибка соеднинения с бд: " . $e);
        }
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setQuery($new_query)
    {
        $this->query = $new_query;
    }

    public function get()
    {
        try {
            $query = $this->getQuery();
            if ($sql = $this->connection->query($query)) {
                $num = $sql->num_rows;
                if ($num == 1) {
                    return $sql->fetch_assoc();
                } else {
                    while ($row = $sql->fetch_all(MYSQLI_ASSOC)) {
                        return $row;
                    }
                }
            } else {
                //сделать потом через сессии
                return "Произошла ошибка при получении данных"; 
            }

            $this->connection->close();
        } catch (\Exception $e) {
            die("Errors: " . $e);
        }
    }

    /**
     * @param array $select
     * @param string $bd_name
     */
    public function select(array $select, string $bd_name)
    {
        $select = Helpers::implode_sql($select, "`");
        $query = "SELECT $select FROM `$bd_name`";
        $this->setQuery($query);
        return $this;
    }

    /**
     * @param string | int $field
     * @param string | int $value
     * @param string $operator
     */
    public function where(string | int $field, string | int $value, string $operator = "=",)
    {
        $sql = $this->query . " WHERE `$field` $operator '$value'";
        $this->setQuery($sql);
        return $this;
    }

    /**
     * @param string $bd_name
     * @param array $values -> принимает ассоциативный массив
     */
    public function insert(string $bd_name, array $values)
    {
        $columns = [];
        $column_values = [];


        foreach ($values as $key => $value) {
            array_push($columns, $key);
            array_push($column_values, $value);
        }

        $final_col = Helpers::implode_sql($columns, "`");

        $final_val = Helpers::implode_sql($column_values, "'");

        try {
            $this->connection->query(
                "INSERT INTO `$bd_name`($final_col) VALUES($final_val)"
            );
        } catch (\Exception $e) {
            die("Error: " . $e);
        }

        $this->connection->close();
    }

    public function delete()
    {
        //code
    }

    public function update()
    {
        //code
    }

    public function join()
    {
        //code
    }
}
