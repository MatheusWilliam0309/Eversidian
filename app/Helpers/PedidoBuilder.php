<?php
    include_once __DIR__ . '/../Model/Pedido.php';

    class PedidoBuilder {
        private $idUsuario;
        private $itens = array();
        private $total = 0.0;

        public function setUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
            return $this;
        }

        public function addItem($idProduto, $quantidade, $preco) {
            $this->itens[] = array(
                'id_produto' => $idProduto,
                'quantidade' => $quantidade,
                'preco' => $preco
            );
            $this->total += ($preco * $quantidade);
            return $this;
        }

        public function build() {
            $pedidoModel = new Pedido();
            $idPedido = $pedidoModel->create($this->idUsuario, $this->total);

            foreach ($this->itens as $item) {
                $pedidoModel->addItem($idPedido, $item['id_produto'], $item['quantidade'], $item['preco']);
            }

            return array('id_pedido' => $idPedido, 'total' => $this->total);
        }
    }
?>