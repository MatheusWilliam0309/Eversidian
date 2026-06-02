<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Personagem {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        // [CREATE] Cria um novo personagem vinculado ao usuário, raça e classe
        public function create($idUsuario, $idRaca, $idClasse, $nome) {
            $stmt = $this->db->prepare("
                INSERT INTO personagens (id_usuario, id_raca, id_classe, nome, nivel, experiencia, vida, mana, forca, agilidade, inteligencia, ouro) 
                VALUES (:id_usuario, :id_raca, :id_classe, :nome, 1, 0, 100, 100, 10, 10, 10, 0)
            "); // Valores base definidos na RN013 e RN014
            
            return $stmt->execute(array(
                'id_usuario' => $idUsuario,
                'id_raca' => $idRaca,
                'id_classe' => $idClasse,
                'nome' => $nome
            ));
        }

        // [READ] Busca todos os personagens de um usuário específico
        public function findByUsuario($idUsuario) {
            $stmt = $this->db->prepare("
                SELECT p.*, r.nome as raca_nome, c.nome as classe_nome 
                FROM personagens p
                INNER JOIN racas r ON p.id_raca = r.id
                INNER JOIN classes c ON p.id_classe = c.id
                WHERE p.id_usuario = :id_usuario
            ");
            $stmt->execute(array('id_usuario' => $idUsuario));
            return $stmt->fetchAll();
        }

        // [UPDATE] Evolui atributos do personagem (UC015)
        public function evoluir($id, $vida, $mana, $forca, $agilidade, $inteligencia) {
            $stmt = $this->db->prepare("
                UPDATE personagens 
                SET vida = :vida, mana = :mana, forca = :forca, agilidade = :agilidade, inteligencia = :inteligencia, nivel = nivel + 1 
                WHERE id = :id
            ");
            
            return $stmt->execute(array(
                'vida' => $vida,
                'mana' => $mana,
                'forca' => $forca,
                'agilidade' => $agilidade,
                'inteligencia' => $inteligencia,
                'id' => $id
            ));
        }

        // [DELETE] Exclui o personagem do usuário
        public function delete($id, $idUsuario) {
            $stmt = $this->db->prepare("DELETE FROM personagens WHERE id = :id AND id_usuario = :id_usuario");
            return $stmt->execute(array('id' => $id, 'id_usuario' => $idUsuario));
        }
    }
?>