<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Categoria {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function findAll() {
            $stmt = $this->db->query("SELECT * FROM categorias ORDER BY nome ASC");
            return $stmt->fetchAll();
        }

        public function findById($id) {
            $stmt = $this->db->prepare("SELECT * FROM categorias WHERE id = :id LIMIT 1");
            $stmt->execute(array('id' => $id));
            return $stmt->fetch();
        }

        public function create($nome, $descricao) {
            $stmt = $this->db->prepare("INSERT INTO categorias (nome, descricao) VALUES (:nome, :descricao)");
            return $stmt->execute(array(
                'nome' => $nome,
                'descricao' => $descricao
            ));
        }
    }
?>