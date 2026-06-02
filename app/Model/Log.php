<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Log {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        /**
         * Registra uma ação no banco de dados para auditoria.
         */
        public function registrarAcao($idUsuario, $acao) {
            // Captura o IP do usuário, com fallback caso não esteja disponível
            $ipAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
            
            $stmt = $this->db->prepare("INSERT INTO logs (id_usuario, acao, ip_address) VALUES (:id_usuario, :acao, :ip_address)");
            
            return $stmt->execute(array(
                'id_usuario' => $idUsuario,
                'acao'       => $acao,
                'ip_address' => $ipAddress
            ));
        }
    }
?>