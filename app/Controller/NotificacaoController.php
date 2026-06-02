<?php
    include_once __DIR__ . '/../Model/Notificacao.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';

    class NotificacaoController {
        private $notificacaoModel;

        public function __construct() {
            AuthMiddleware::check();
            $this->notificacaoModel = new Notificacao();
        }

        public function index() {
            $idUsuario = Session::get('user_id');
            $notificacoes = $this->notificacaoModel->findByUsuario($idUsuario);
            
            include_once __DIR__ . '/../View/Social/notificacoes.php';
        }

        public function ler($idNotificacao) {
            $idUsuario = Session::get('user_id');
            $this->notificacaoModel->markAsRead($idNotificacao, $idUsuario);
            
            header('Location: /notificacoes');
            exit;
        }
    }
?>