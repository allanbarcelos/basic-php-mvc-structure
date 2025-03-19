<?php

class Controller {
    protected function view($view, $data = [], $includeSidebar = false){
        extract($data);

        require_once __DIR__ . '/../views/layouts/header.php';

        if($includeSidebar){
            require_once __DIR__ . '/../views/layouts/sidebar.php';
        }

        require_once __DIR__ . '/../views/' . $view . '.php';

        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    protected function isAuthenticated(){
        if(!isset($_SESSION['user_id'])){
            header('Location: /auth/login');
            exit();
        }
    }
}