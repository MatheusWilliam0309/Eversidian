<?php
    include_once __DIR__ . '/../AbstractLojaFactory.php';

    class ProdutoVirtual implements IProduto {
        private $dados;

        public function __construct($dados) {
            $this->dados = $dados;
        }

        public function getDetalhes() {
            return "Conhecimento Arcano (Digital): " . $this->dados['nome'];
        }

        public function precisaBaixarEstoque() {
            return false; // RN056: Produtos virtuais não utilizam sistema de entrega física ou estoque limitante
        }
    }
?>