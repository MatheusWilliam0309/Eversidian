<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Mensagem {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function saveCampaignMessage($idRemetente, $idCampanha, $mensagem) {
            $stmt = $this->db->prepare("INSERT INTO mensagens (id_remetente, id_campanha, mensagem) VALUES (:remetente, :campanha, :msg)");
            return $stmt->execute(array(
                'remetente' => $idRemetente,
                'campanha' => $idCampanha,
                'msg' => $mensagem
            ));
        }

        public function getCampaignHistory($idCampanha) {
            $stmt = $this->db->prepare("
                SELECT m.*, u.nome_usuario, u.foto_perfil 
                FROM mensagens m
                INNER JOIN usuarios u ON m.id_remetente = u.id
                WHERE m.id_campanha = :id_campanha
                ORDER BY m.created_at ASC
            ");
            $stmt->execute(array('id_campanha' => $idCampanha));
            return $stmt->fetchAll();
        }
    }
?>