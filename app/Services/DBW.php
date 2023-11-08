<?php

namespace App\Services;
use App\Services\Helpers\Helpers;
use App\Services\Traits\ArrayToQuery;

class DBW
{
    private string $DB_HOST = 'localhost';
    private string $DB_PORT = '3306';
    private string $DB_NAME = "solesprint";
    private string $DB_USERNAME = "root";
    private string $DB_PASSWORD = "";
    private $connection;

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

    public function get()
    {
        //code
    }

    /**
     * @param string $bd_name
     * @param array $select
     */
    public function select(array $select, string $bd_name)
    {
        $select = Helpers::implode_sql($select, "`");
        if ($sql = $this->connection->query("SELECT $select FROM `$bd_name`")) {
            return $sql->fetch_assoc();
        } else {
            return "Произошла ошибка при получении данных";
        }
    }

    /**
     * @param string $bd_name
     * @param array $values
     */
    public function insert(string $bd_name, array $values)
    {
        $columns = [];
        $column_values = [];
        

        foreach ($values as $key => $value) {
            array_push($columns, $key);
            array_push($column_values, $value);
        }

        $final_col = Helpers::implode_sql($columns);

        $final_val = Helpers::implode_sql($column_values);

        try {
            $this->connection->query(
                "INSERT INTO `$bd_name`($final_col) VALUES($final_val)"
            );
        } catch (\Exception $e) {
            die("Error: ". $e);
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

    public function where()
    {
        //code
    }

    public function join()
    {
        //code
    }
}
