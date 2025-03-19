<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Middleware.php';

class UserController extends Controller {

    public function __construct() {
        session_start();
    }
    
    public function index() {

        $this->isAuthenticated();
        
        $userModel = new User();
        $users = $userModel->findAll();
        $this->view('user/index', ['users' => $users, 'userModel' => $userModel ], true);
    }

    public function create() {

        Middleware::authorize('create_user');

        $page = [
            'title' => 'Create User'
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if(empty($name) || empty($email) || empty($password) ){
                echo "All field are required";
                return;
            }

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ];

            $userModel = new User();

            if($userModel->create($data)){
                echo "User added with success";
            }else {
                echo "Failed to create user";
            }
        }

        $this->view('user/create', $page);
    }

}