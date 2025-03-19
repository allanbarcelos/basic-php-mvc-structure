<?php
require_once __DIR__ . '/../core/Controller.php';

class ProductsController extends Controller {
    public function __construct() {
        session_start();
    }

    public function index() {
        $this->view('products/index');
    }
}