<?php
    interface AbstractLojaFactory {
        public function instanciarProduto($dadosBanco);
        public function instanciarProcessadorEntrega();
    }

    interface IProduto {
        public function getDetalhes();
        public function precisaBaixarEstoque();
    }

    interface IProcessadorEntrega {
        public function organizarEnvio($idPedido, $idUsuario);
    }
?>