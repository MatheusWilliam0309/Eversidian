<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Pedido {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function create($idUsuario, $total) {
            $stmt = $this->db->prepare("INSERT INTO pedidos (id_usuario, total, status) VALUES (:id_usuario, :total, 'pendente')");
            $stmt->execute(array('id_usuario' => $idUsuario, 'total' => $total));
            return $this->db->lastInsertId();
        }

        public function addItem($idPedido, $idProduto, $quantidade, $preco) {
            $stmt = $this->db->prepare("INSERT INTO pedido_itens (id_pedido, id_produto, quantidade, preco) VALUES (:id_pedido, :id_produto, :quantidade, :preco)");
            return $stmt->execute(array('id_pedido' => $idPedido, 'id_produto' => $idProduto, 'quantidade' => $quantidade, 'preco' => $preco));
        }

        // Aplicação conceitual do padrão State para alterar o comportamento/estágio da entidade
        public function updateStatus($idPedido, $novoStatus) {
            $stmt = $this->db->prepare("UPDATE pedidos SET status = :status WHERE id = :id");
            return $stmt->execute(array('status' => $novoStatus, 'id' => $idPedido));
        }
    }
?>