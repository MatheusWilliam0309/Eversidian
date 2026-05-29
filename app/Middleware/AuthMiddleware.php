<?php
    include_once __DIR__ . '/../Core/Session.php';

    class AuthMiddleware {
        public static function check() {
            Session::start();
            if (!Session::has('user_id')) {
                Session::set('erro', 'Acesso negado. Identifique-se primeiro.');
                header('Location: /login');
                exit;
            }
        }
    }
?>