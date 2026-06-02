<?php
include_once __DIR__ . '/../Core/Database.php';

    class Amizade {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function sendRequest($idUsuario, $idAmigo) {
            // Evita duplicidade de convites
            $stmtCheck = $this->db->prepare("SELECT id FROM amizades WHERE (id_usuario = :id1 AND id_amigo = :id2) OR (id_usuario = :id2 AND id_amigo = :id1)");
            $stmtCheck->execute(array('id1' => $idUsuario, 'id2' => $idAmigo));
            
            if ($stmtCheck->fetch()) {
                return false; // Já existe um vínculo ou convite
            }

            $stmt = $this->db->prepare("INSERT INTO amizades (id_usuario, id_amigo, status) VALUES (:id_usuario, :id_amigo, 'Pendente')");
            return $stmt->execute(array('id_usuario' => $idUsuario, 'id_amigo' => $idAmigo));
        }

        public function updateStatus($idAmizade, $idAmigoDestino, $status) {
            // Garante que apenas quem recebeu o convite pode aceitar/rejeitar
            $stmt = $this->db->prepare("UPDATE amizades SET status = :status WHERE id = :id AND id_amigo = :id_amigo");
            return $stmt->execute(array('status' => $status, 'id' => $idAmizade, 'id_amigo' => $idAmigoDestino));
        }

        public function findFriends($idUsuario) {
            $stmt = $this->db->prepare("
                SELECT u.id, u.nome_usuario, u.foto_perfil 
                FROM amizades a
                INNER JOIN usuarios u ON (a.id_amigo = u.id OR a.id_usuario = u.id)
                WHERE (a.id_usuario = :id1 OR a.id_amigo = :id2) AND a.status = 'Aceito' AND u.id != :id3
            ");
            $stmt->execute(array('id1' => $idUsuario, 'id2' => $idUsuario, 'id3' => $idUsuario));
            return $stmt->fetchAll();
        }
    }
?>