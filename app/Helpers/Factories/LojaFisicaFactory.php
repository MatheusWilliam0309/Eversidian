<?php
    include_once __DIR__ . '/AbstractLojaFactory.php';
    include_once __DIR__ . '/Fisico/ProdutoFisico.php';

    class LojaFisicaFactory implements AbstractLojaFactory {
        public function instanciarProduto($dadosBanco) {
            return new ProdutoFisico($dadosBanco);
        }

        public function instanciarProcessadorEntrega() {
            return new EntregaFisica();
        }
    }
?>