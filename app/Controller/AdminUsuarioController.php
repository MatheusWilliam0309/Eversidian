<?php
    include_once __DIR__ . '/../Model/Usuario.php';
    include_once __DIR__ . '/../Model/Log.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';
    include_once __DIR__ . '/../Middleware/AdminMiddleware.php';

    class AdminUsuarioController {
        private $db;
        private $usuarioModel;
        private $logModel;

        public function __construct() {
            AuthMiddleware::check();
            AdminMiddleware::check();
            $this->db = Database::getInstance();
            $this->usuarioModel = new Usuario();
            $this->logModel = new Log();
        }

        public function index() {
            // Traz também a coluna banido_ate e ordena para a numeração sequencial
            $stmt = $this->db->query("SELECT id, nome_usuario, email, role, status, banido_ate, created_at FROM usuarios ORDER BY id ASC");
            $usuarios = $stmt->fetchAll();
            
            include_once __DIR__ . '/../View/Admin/usuarios_lista.php';
        }

        public function criarAdmin($postData) {
            $idAdmin = Session::get('user_id');
            $nome = trim($postData['nome_usuario']);
            $email = trim($postData['email']);
            $senha = $postData['senha'];

            if (empty($nome) || empty($email) || empty($senha)) {
                Session::set('erro', 'Todos os selos são necessários para forjar um novo Mestre.');
                header('Location: ' . BASE_DIR . '/admin/usuarios');
                exit;
            }

            if ($this->usuarioModel->checkExists($email, $nome)) {
                Session::set('erro', 'Esta identidade ou selo de contacto já pertencem a outra entidade.');
                header('Location: ' . BASE_DIR . '/admin/usuarios');
                exit;
            }

            $senhaHash = password_hash($senha, PASSWORD_ARGON2ID);

            if ($this->usuarioModel->createAdmin($nome, $email, $senhaHash)) {
                $this->logModel->registrarAcao($idAdmin, "Elevou a entidade {$nome} ao cargo de Mestre do Vácuo.");
                Session::set('sucesso', 'Um novo Mestre do Vácuo foi conjurado com sucesso.');
            } else {
                Session::set('erro', 'Falha ao realizar o rito de ascensão.');
            }

            header('Location: ' . BASE_DIR . '/admin/usuarios');
            exit;
        }

        public function banir($postData) {
            $idAlvo = (int) $postData['id_usuario'];
            $idAdmin = Session::get('user_id');
            $tipoBan = $postData['tipo_ban']; 
            $diasExilio = isset($postData['dias']) ? (int) $postData['dias'] : 0;

            if ($idAlvo === $idAdmin) {
                Session::set('erro', 'Não podes exilar a ti mesmo.');
                header('Location: ' . BASE_DIR . '/admin/usuarios');
                exit;
            }

            if ($tipoBan === 'temporario' && $diasExilio > 0) {
                $stmt = $this->db->prepare("UPDATE usuarios SET status = 'banido', banido_ate = DATE_ADD(NOW(), INTERVAL :dias DAY) WHERE id = :id");
                $sucesso = $stmt->execute(['dias' => $diasExilio, 'id' => $idAlvo]);
                if ($sucesso) {
                    $this->logModel->registrarAcao($idAdmin, "Exilou temporariamente o escriba #{$idAlvo} por {$diasExilio} dias.");
                    Session::set('sucesso', "A alma foi exilada por {$diasExilio} dias.");
                }
            } else {
                $stmt = $this->db->prepare("UPDATE usuarios SET status = 'banido', banido_ate = NULL WHERE id = :id");
                $sucesso = $stmt->execute(['id' => $idAlvo]);
                if ($sucesso) {
                    $this->logModel->registrarAcao($idAdmin, "Baniu permanentemente o escriba #{$idAlvo}.");
                    Session::set('sucesso', "A alma foi banida para o fundo do Vácuo eternamente.");
                }
            }

            header('Location: ' . BASE_DIR . '/admin/usuarios');
            exit;
        }

        public function revogarBan($postData) {
            $idAlvo = (int) $postData['id_usuario'];
            $idAdmin = Session::get('user_id');

            if ($this->usuarioModel->restaurarStatus($idAlvo)) {
                $this->logModel->registrarAcao($idAdmin, "Revogou o banimento da alma #{$idAlvo}.");
                Session::set('sucesso', 'O perdão foi concedido. A alma está livre.');
            } else {
                Session::set('erro', 'Falha ao conceder o perdão.');
            }

            header('Location: ' . BASE_DIR . '/admin/usuarios');
            exit;
        }

        public function excluir($postData) {
            $idAlvo = (int) $postData['id_usuario'];
            $idAdmin = Session::get('user_id');

            if ($idAlvo === $idAdmin) {
                Session::set('erro', 'É impossível obliterar a própria existência através do painel.');
                header('Location: ' . BASE_DIR . '/admin/usuarios');
                exit;
            }

            if ($this->usuarioModel->delete($idAlvo)) {
                $this->logModel->registrarAcao($idAdmin, "Oblitrou o utilizador #{$idAlvo} da base de dados.");
                Session::set('sucesso', 'A alma foi obliterada e não existe mais nos registos do Vácuo.');
            } else {
                Session::set('erro', 'Esta alma possui fortes amarras (Personagens, Mensagens ou Guildas). Para a excluir, deves apagar os seus pertences primeiro ou usar o Banimento Permanente.');
            }

            header('Location: ' . BASE_DIR . '/admin/usuarios');
            exit;
        }
    }
?>