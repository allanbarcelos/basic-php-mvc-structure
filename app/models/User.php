<?php
require_once __DIR__ . '/../core/Model.php';

class User extends Model {

    protected $table = 'users';

    // $data = array()
    public function create($data){

        if(isset($data['name'], $data['email'], $data['password'])){
            return false;
        }

        $hash_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $role_id = $data['role_id'] ?? 3;

        $sql = "INSERT INTO {$this->table} (name, email, password, role_id) VALUES (:name,:email, :password, :role_id)";
        $this->query($sql);

        $this->bind(':name', trim($data['name'])); // TRIM avoid undesirable spaces 
        $this->bind(':email', filter_var($data['email'], FILTER_SANITIZE_EMAIL)); // email sanitize
        $this->bind(':password', $hash_password);
        $this->bind(':role_id', $role_id);

        return $this->execute();
    }

    public function findById($id){
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $this->query($sql);
        $this->bind(':id', $id);
        return $this->single();
    }

    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        $this->query($sql);
        return $this->resultSet();
    }

    public function findByEmail($email){
        $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $this->query($sql);
        $this->bind(':email', filter_var($email, FILTER_SANITIZE_EMAIL));
        $result = $this->single();
        return $result ?: null;
    }

    public function update($id, $data){
        $sql = "UPDATE {$this->table} SET name = :name, email = :email, role_id = :role_id WHERE id = :id";
        $this->query($sql);

        $this->bind(':name', trim($data['name']));
        $this->bind(':email', filter_var($data['email'], FILTER_SANITIZE_EMAIL));
        $this->bind(':role_id', $data['role_id'] ?? 3);
        $this->bind(':id', $id);

        return $this-> execute();

    }


    public function delete($id){
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $this->query($sql);
        $this->bind(':id', $id);
        return $this->execute();
    }

    public function getRole($user_id){
        $sql = "SELECT r.* FROM roles r JOIN users u ON u.role_id = r.id WHERE u.id = :user_id";
        $this->query($sql);
        $this->bind(':user_id', $user_id);
        return $this->single();
    }

    public function hasPermission($user_id, $permissionName){
        $sql = "SELECT p.name FROM permissions p 
                JOIN role_permissions rp ON rp.permission_id = p.id 
                JOIN roles r ON r.id = rp.role_id 
                JOIN users u ON u.role_id = r.id 
                WHERE u.id = :user_id AND p.name = :permission_name";

        $this->query($sql);
        $this->bind(':user_id', $user_id);
        $this->bind(':permission_name', $permissionName);
        return $this->single() != false;
    }
}