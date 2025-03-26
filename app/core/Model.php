<?php
require_once __DIR__ . '/../core/Database.php';

class Model {
    protected $db;

    protected $table;
    protected $columns = [];

    public function __construct(){
        $this->db = new Database();
        if(!empty($this->table) && !empty($this->columns)){
            $this->createTableIfNotExists();
        }
    }

    public function query($sql){
        $this->db->query($sql);
    }

    public function bind($param, $value, $type = null){
        $this->db->bind($param, $value, $type);
    }

    public function execute(){
        return $this->db->execute();
    }

    
    public function resultSet() {
        return $this->db->resultSet();

    }

    public function single(){
        return $this->db->single();

    }

    // 

    public function createTableIfNotExists()
    {
        $columnsSql = [];
        foreach ($this->columns as $name => $type) {
            $columnsSql[] = "`$name` $type";
        }

        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (" . implode(", ", $columnsSql) . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->query($sql);
        $this->execute();
    }

}