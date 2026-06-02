<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Notificacao {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function create($idUsuario, $titulo, $conteudo) {
            $stmt = $this->db->prepare("INSERT INTO notificacoes (id_usuario, titulo, conteudo) VALUES (:id_usuario, :titulo, :conteudo)");
            return $stmt->execute(array(
                'id_usuario' => $idUsuario,
                'titulo' => $titulo,
                'conteudo' => $conteudo
            ));
        }

        public function findByUsuario($idUsuario) {
            $stmt = $this->db->prepare("SELECT * FROM notificacoes WHERE id_usuario = :id_usuario ORDER BY created_at DESC");
            $stmt->execute(array('id_usuario' => $idUsuario));
            return $stmt->fetchAll();
        }

        public function markAsRead($idNotificacao, $idUsuario) {
            $stmt = $this->db->prepare("UPDATE notificacoes SET is_read = TRUE WHERE id = :id AND id_usuario = :id_usuario");
            return $stmt->execute(array('id' => $idNotificacao, 'id_usuario' => $idUsuario));
        }
    }
?>