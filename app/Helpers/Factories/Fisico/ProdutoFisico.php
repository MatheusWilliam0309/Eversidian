<?php
    include_once __DIR__ . '/../AbstractLojaFactory.php';

    class ProdutoFisico implements IProduto {
        private $dados;

        public function __construct($dados) {
            $this->dados = $dados;
        }

        public function getDetalhes() {
            return "Artefato Físico: " . $this->dados['nome'];
        }

        public function precisaBaixarEstoque() {
            return true; // RN057: Produtos físicos devem possuir controle de estoque
        }
    }
?>