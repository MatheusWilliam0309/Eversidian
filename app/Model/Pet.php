<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Pet {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function create($idPersonagem, $nome, $especie) {
            $stmt = $this->db->prepare("INSERT INTO pets (id_personagem, nome, especie, nivel, vida) VALUES (:id_personagem, :nome, :especie, 1, 100)");
            return $stmt->execute(array(
                'id_personagem' => $idPersonagem,
                'nome' => $nome,
                'especie' => $especie
            ));
        }

        public function findByPersonagem($idPersonagem) {
            $stmt = $this->db->prepare("SELECT * FROM pets WHERE id_personagem = :id_personagem");
            $stmt->execute(array('id_personagem' => $idPersonagem));
            return $stmt->fetchAll();
        }
    }
?>