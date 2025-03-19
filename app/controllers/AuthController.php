<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller {
    public function login() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if(empty($email) || empty($password)){
                echo "Email and Password are required";
                return;
            }

            $userModel = new User();

            $user = $userModel->findByEmail($email);

            if($user && password_verify($password, $user->password)){
                session_start();
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['user_name'] = $user->name;
                $_SESSION['user_role'] = $user->role_id;

                header('Location: /');

            }else {
                echo "Invalid email or password.";
            }
        }

        $this->view('auth/login');
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
    }
}