<?php
    include_once __DIR__ . '/../Core/Session.php';

    class AdminMiddleware {
        /**
         * Verifica se o usuário logado possui nível administrativo (RI003 e RN007)
         */
        public static function check() {
            Session::start();
            $role = Session::get('user_role');
            
            // Verifica se é administrador ou moderador
            if ($role !== 'gmAdmin' && $role !== 'moderador') {
                Session::set('erro', 'Acesso negado. Apenas os Mestres do Vácuo possuem tal autoridade.');
                header('Location: /home');
                exit;
            }
        }
    }
?>