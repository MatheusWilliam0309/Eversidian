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

        // Novo método para carregar a página
        public function configuracoes() {
            AuthMiddleware::check();
            include_once __DIR__ . '/../View/Perfil/configuracoes.php';
        }

        // Método de atualização redesenhado
        public function atualizarDados($postData) {
            AuthMiddleware::check();
            $idUsuario = Session::get('user_id');
            $nome = trim($postData['nome_usuario']);
            $email = trim($postData['email']);
            $novaSenha = trim($postData['nova_senha']);
            
            $usuarioModel = new Usuario();

            // 1. Upload da Foto de Perfil
            if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
                $extensao = strtolower(pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION));
                if (in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $fotoNome = 'perfil_' . $idUsuario . '_' . time() . '.' . $extensao;
                    $diretorioDestino = __DIR__ . '/../../Public/Uploads/' . $fotoNome;
                    
                    if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $diretorioDestino)) {
                        $usuarioModel->atualizarFotoPerfil($idUsuario, $fotoNome);
                        $_SESSION['user_foto_perfil'] = $fotoNome; 
                    }
                }
            }

            // 2. Atualizar Nome e E-mail
            if (!empty($nome) && !empty($email)) {
                $usuarioModel->atualizarDadosPerfil($idUsuario, $nome, $email);
                $_SESSION['user_name'] = $nome;
                $_SESSION['user_email'] = $email;
            }

            // 3. Atualizar Senha (Se preenchida usando Argon2id)
            if (!empty($novaSenha)) {
                $senhaHash = password_hash($novaSenha, PASSWORD_ARGON2ID);
                $usuarioModel->atualizarSenha($idUsuario, $senhaHash);
            }
            
            Session::set('sucesso', 'As tuas escrituras e pactos foram atualizados com sucesso.');
            header('Location: ' . BASE_DIR . '/configuracoes');
            exit;
        }
    }
?>