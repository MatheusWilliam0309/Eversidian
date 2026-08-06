<?php
    include_once __DIR__ . '/AbstractLojaFactory.php';
    include_once __DIR__ . '/Virtual/ProdutoVirtual.php';

    class LojaVirtualFactory implements AbstractLojaFactory {
        public function instanciarProduto($dadosBanco) {
            return new ProdutoVirtual($dadosBanco);
        }

        public function instanciarProcessadorEntrega() {
            return new EntregaVirtual();
        }
    }
?>