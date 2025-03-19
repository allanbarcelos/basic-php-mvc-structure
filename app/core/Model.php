<?php
require_once __DIR__ . '/../core/Database.php';

class Model {
    protected $db;

    public function __construct(){
        $this->db = new Database();
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

}