<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Pagamento {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function registrar($idPedido, $metodo, $codigo, $valor, $status) {
            $stmt = $this->db->prepare("INSERT INTO pagamentos (id_pedido, metodo_pagamento, codigo_transacao, valor, status) VALUES (:id_pedido, :metodo, :codigo, :valor, :status)");
            return $stmt->execute(array(
                'id_pedido' => $idPedido,
                'metodo' => $metodo,
                'codigo' => $codigo,
                'valor' => $valor,
                'status' => $status
            ));
        }
    }
?>