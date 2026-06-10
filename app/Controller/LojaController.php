<?php
    include_once __DIR__ . '/../Model/Produto.php';
    include_once __DIR__ . '/../Model/Carrinho.php';
    include_once __DIR__ . '/../Services/LojaFacade.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';

    class LojaController {
        
        // Bloqueia o acesso aos Mestres/Admins
        private function barrarMestres() {
            Session::start();
            $role = Session::get('user_role');
            if ($role === 'gmAdmin' || $role === 'moderador') {
                Session::set('erro', 'Os Mestres do Vácuo não interferem no comércio mortal.');
                header('Location: ' . BASE_DIR . '/admin/produtos');
                exit;
            }
        }

        public function index() {
            $this->barrarMestres();
            $produtoModel = new Produto();
            $produtos = $produtoModel->findAll();
            include_once __DIR__ . '/../View/Loja/index.php';
        }

        public function adicionarAoCarrinho($postData) {
            AuthMiddleware::check();
            $this->barrarMestres();
            
            $idProduto = (int) $postData['id_produto'];
            $quantidade = isset($postData['quantidade']) ? (int) $postData['quantidade'] : 1;
            $idUsuario = Session::get('user_id');

            $carrinhoModel = new Carrinho();
            if ($carrinhoModel->add($idUsuario, $idProduto, $quantidade)) {
                Session::set('sucesso', 'Artefato armazenado no seu inventário de compras.');
            } else {
                Session::set('erro', 'A magia falhou. Tente novamente.');
            }

            header('Location: ' . BASE_DIR . '/loja');
            exit;
        }

        public function verCarrinho() {
            AuthMiddleware::check();
            $this->barrarMestres();
            $idUsuario = Session::get('user_id');
            
            $carrinhoModel = new Carrinho();
            $itensCarrinho = $carrinhoModel->getItems($idUsuario);
            
            $total = 0;
            foreach ($itensCarrinho as $item) {
                $total += ($item['preco'] * $item['quantidade']);
            }

            include_once __DIR__ . '/../View/Loja/carrinho.php';
        }

        public function finalizarCompra($postData) {
            AuthMiddleware::check();
            $this->barrarMestres();
            $idUsuario = Session::get('user_id');
            $metodoPagamento = $postData['metodo_pagamento']; 

            try {
                $facade = new LojaFacade();
                $idPedido = $facade->realizarCheckout($idUsuario, $metodoPagamento);
                
                Session::set('sucesso', "Transação concluída. O Vácuo aceitou sua oferenda. (Pedido #$idPedido)");
                header('Location: ' . BASE_DIR . '/loja/historico');
                exit;
            } catch (Exception $e) {
                Session::set('erro', $e->getMessage());
                header('Location: ' . BASE_DIR . '/loja/carrinho');
                exit;
            }
        }
    }
?>