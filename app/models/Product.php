<?php
require_once __DIR__ . '/../core/Model.php';

class Product extends Model
{

    protected $table = 'products';


    // $data = array()
    public function create($data)
    {

        if (isset($data['title'], $data['description'], $data['brand'], $data['model'], $data['price'], $data['quantity'])) {
            return false;
        }

        $sql = "INSERT INTO {$this->table} (title, description, brand, model, price, quantity) VALUES (:title, :description, :brand, :model, :price, :quantity)";
        $this->query($sql);

        $this->bind(':title', trim($data['title'])); // TRIM avoid undesirable spaces 
        $this->bind(':description', trim($data['description'])); 
        $this->bind(':brand', trim($data['brand'])); 
        $this->bind(':model', trim($data['model'])); 
        $this->bind(':price', $data['price']); 
        $this->bind(':quantity', $data['quantity']);

        return $this->execute();
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $this->query($sql);
        $this->bind(':id', $id);
        return $this->single();
    }

    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $this->query($sql);
        return $this->resultSet();
    }

    public function findByBrand($brand)
    {
        $sql = "SELECT * FROM {$this->table} WHERE brand = :brand";
        $this->query($sql);
        $this->bind(':brand', trim($brand));
        $result = $this->resultSet();
        return $result ?: null;
    }

    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} SET title = :title, description = :description, brand = :brand, model = :model, price = :price, quantity = :quantity WHERE id = :id";
        $this->query($sql);

        $this->bind(':title', trim($data['title'])); // TRIM avoid undesirable spaces 
        $this->bind(':description', trim($data['description'])); 
        $this->bind(':brand', trim($data['brand'])); 
        $this->bind(':model', trim($data['model'])); 
        $this->bind(':price', $data['price']); 
        $this->bind(':quantity', $data['quantity']);

        return $this->execute();
    }


    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $this->query($sql);
        $this->bind(':id', $id);
        return $this->execute();
    }
}
