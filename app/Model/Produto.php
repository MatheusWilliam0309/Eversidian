<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Produto {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function findAll() { //Procura todos os produtos no Banco de Dados
            $stmt = $this->db->query("SELECT * FROM produtos WHERE estoque > 0 ORDER BY created_at DESC");
            return $stmt->fetchAll();
        }

        public function findById($id) { //Procura produto específico
            $stmt = $this->db->prepare("SELECT * FROM produtos WHERE id = :id LIMIT 1");
            $stmt->execute(array('id' => $id));
            return $stmt->fetch();
        }

        public function baixarEstoque($id, $quantidade) { //Exibe o estoque
            $stmt = $this->db->prepare("UPDATE produtos SET estoque = estoque - :qtd WHERE id = :id AND estoque >= :qtd");
            return $stmt->execute(array('qtd' => $quantidade, 'id' => $id));
        }
    }
?>