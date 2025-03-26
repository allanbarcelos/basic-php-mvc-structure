<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Product.php';

class ProductsController extends Controller {
    public function __construct() {
        session_start();
    }

    public function index() {

        $this->isAuthenticated();
        
        $productModel = new Product();
        $products = $productModel->findAll();
        $this->view('products/index', ['products' => $products, 'productModel' => $productModel ], true);
    }
}