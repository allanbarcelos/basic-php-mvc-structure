<?php
require_once __DIR__ . '/../core/Model.php';

class User extends Model {

    protected $table = 'users';

    // $data = array()
    public function create($data){
        $sql = "INSERT INTO {$this->table} (name, email, password, role_id) VALUES (:name,:email, :password, :role_id)";
        $this->query($sql);

        $this->bind(':name', $data['name']);
        $this->bind(':email', $data['email']);
        $this->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->bind(':role_id', $data['role_id'] ?? 3);

        return $this->execute();
    }

    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        $this->query($sql);
        return $this->resultSet();
    }

    public function findByEmail($email){
        $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $this->query($sql);
        $this->bind(':email', $email);
        return $this->single();
    }

    public function getRole(){
        $sql = "SELECT r.* FROM roles r JOIN users u ON u.role_id = r.id WHERE u.id = :user_id";
        $this->query($sql);
        $this->bind(':user_id', $_SESSION['user_id']);
        return $this->single();
    }

    public function hasPermission($permissionName){
        $sql = "SELECT p.name FROM permissions p 
                JOIN role_permissions rp ON rp.permission_id = p.id 
                JOIN roles r ON r.id = rp.role_id 
                JOIN users u ON u.role_id = r.id 
                WHERE u.id = :user_id AND p.name = :permission_name";

        $this->query($sql);
        $this->bind(':user_id', $_SESSION['user_id']);
        $this->bind(':permission_name', $permissionName);
        return $this->single() != false;
    }
}