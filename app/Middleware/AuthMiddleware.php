<?php
    include_once __DIR__ . '/../Core/Session.php';

    class AuthMiddleware {
        public static function check() {
            Session::start();
            
            if (!isset($_SESSION['user_id'])) {
                Session::set('erro', 'Você precisa despertar (fazer login) para acessar este plano.');
                
                // Aqui aplicamos a constante para os redirecionamentos do backend
                header('Location: ' . BASE_DIR . '/login');
                exit;
            }
        }
    }
    
?>