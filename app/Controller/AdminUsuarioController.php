<?php
    include_once __DIR__ . '/../Model/Usuario.php';
    include_once __DIR__ . '/../Model/Log.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';
    include_once __DIR__ . '/../Middleware/AdminMiddleware.php';

    class AdminUsuarioController {
        private $db;

        public function __construct() {
            AuthMiddleware::check();
            AdminMiddleware::check();
            $this->db = Database::getInstance();
        }

        public function index() {
            $stmt = $this->db->query("SELECT id, nome_usuario, email, role, status, created_at FROM usuarios ORDER BY id DESC");
            $usuarios = $stmt->fetchAll();
            
            include_once __DIR__ . '/../View/Admin/usuarios_lista.php';
        }

        public function banir($postData) {
            $idAlvo = (int) $postData['id_usuario'];
            $idAdmin = Session::get('user_id');
            $tipoBan = $postData['tipo_ban']; // Deve vir do form HTML: 'permanente' ou 'temporario'
            $diasExilio = isset($postData['dias']) ? (int) $postData['dias'] : 0;

            if ($idAlvo === $idAdmin) {
                Session::set('erro', 'Você não pode banir sua própria alma.');
                header('Location: /admin/usuarios');
                exit;
            }

            $logModel = new Log();

            if ($tipoBan === 'temporario' && $diasExilio > 0) {
                // O MySQL adiciona os dias à data atual do servidor
                $stmt = $this->db->prepare("UPDATE usuarios SET status = 'banido', banido_ate = DATE_ADD(NOW(), INTERVAL :dias DAY) WHERE id = :id");
                $sucesso = $stmt->execute(array('dias' => $diasExilio, 'id' => $idAlvo));
                
                if ($sucesso) {
                    $logModel->registrarAcao($idAdmin, "Exilou temporariamente o usuário #{$idAlvo} por {$diasExilio} dias.");
                    Session::set('sucesso', "A alma foi exilada por {$diasExilio} dias.");
                }
            } else {
                // Banimento Permanente
                $stmt = $this->db->prepare("UPDATE usuarios SET status = 'banido', banido_ate = NULL WHERE id = :id");
                $sucesso = $stmt->execute(array('id' => $idAlvo));
                
                if ($sucesso) {
                    $logModel->registrarAcao($idAdmin, "Baniu permanentemente o usuário #{$idAlvo}.");
                    Session::set('sucesso', "A alma foi banida para o fundo do Vácuo eternamente.");
                }
            }

            if (!$sucesso) {
                Session::set('erro', 'Não foi possível aplicar o castigo.');
            }

            header('Location: /admin/usuarios');
            exit;
        }
    }
?>