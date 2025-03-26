<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Product.php';

class DatabaseSeeder {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function run() {
        $this->seedProducts();
    }

    private function seedProducts() {
        $product = new Product();

        // Check if products already exist to prevent duplication
        $existingProducts = $product->findAll();
        if (!empty($existingProducts)) {
            echo "Seed has already been executed. No data inserted.\n";
            return;
        }

        $products = [
            [
                'title' => 'Dell Inspiron Laptop',
                'description' => 'High-performance laptop for work and study.',
                'brand' => 'Dell',
                'model' => 'Inspiron 15 3000',
                'price' => 3500.99,
                'quantity' => 10
            ],
            [
                'title' => 'Samsung Galaxy S21 Smartphone',
                'description' => 'Smartphone with a high-resolution camera and excellent performance.',
                'brand' => 'Samsung',
                'model' => 'Galaxy S21',
                'price' => 2999.90,
                'quantity' => 15
            ],
            [
                'title' => 'LG UltraWide Monitor',
                'description' => '29-inch monitor with an UltraWide display.',
                'brand' => 'LG',
                'model' => 'UltraWide 29UM69G',
                'price' => 1200.00,
                'quantity' => 8
            ]
        ];

        foreach ($products as $data) {
            $product->create($data);
        }

        echo "Seed executed successfully! Products inserted.\n";
    }
}
