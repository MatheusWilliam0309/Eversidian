<?php
    require_once __DIR__ . '/../Core/Session.php';
    require_once __DIR__ . '/../Middleware/AuthMiddleware.php';
    require_once __DIR__ . '/../Model/Usuario.php';

    class UsuarioController {
        private $usuarioModel;

        public function __construct() {
            // 1. Invoca a segurança absoluta: Apenas utilizadores logados passam daqui
            AuthMiddleware::check();
            
            // 2. Instancia o Model para interagir com a base de dados
            $this->usuarioModel = new Usuario();
        }

        /**
         * Exibe o ecrã do Perfil (Visão Geral)
         */
        public function index() {
            Session::start();
            $id = $_SESSION['user_id'];

            // Busca os dados atualizados do utilizador na base de dados
            $escriba = $this->usuarioModel->findById($id);

            if (!$escriba) {
                Session::set('erro', 'O seu pacto não foi encontrado nos registos.');
                header('Location: ' . BASE_DIR . '/login');
                exit;
            }

            // Carrega a View do Perfil (que iremos construir a seguir)
            require_once __DIR__ . '/../View/Perfil/index.php';
        }

        /**
         * Processa a atualização de dados básicos (Nome e E-mail)
         */
        public function atualizarDados($postData) {
            Session::start();
            $id = $_SESSION['user_id'];
            
            $nome = trim($postData['nome_usuario']);
            $email = trim($postData['email']);

            if (empty($nome) || empty($email)) {
                Session::set('erro', 'Os campos de Nome e Selo de Contacto não podem ficar vazios.');
                header('Location: ' . BASE_DIR . '/perfil');
                exit;
            }

            // Atualiza na base de dados (Assumindo que criaremos o método update no Model)
            if ($this->usuarioModel->update($id, $nome, $email)) {
                // Atualiza a sessão com o novo nome
                Session::set('user_name', $nome);
                Session::set('sucesso', 'Os seus registos foram reescritos com sucesso.');
            } else {
                Session::set('erro', 'Falha ao atualizar as antigas escrituras.');
            }

            header('Location: ' . BASE_DIR . '/perfil');
            exit;
        }
    }
?>