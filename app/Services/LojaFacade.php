<?php
    include_once __DIR__ . '/../Model/Carrinho.php';
    include_once __DIR__ . '/../Model/Produto.php';
    include_once __DIR__ . '/../Model/Pagamento.php';
    include_once __DIR__ . '/../Helpers/PedidoBuilder.php';
    include_once __DIR__ . '/../Helpers/PagamentoFactory.php';
    include_once __DIR__ . '/../Model/Log.php';
    include_once __DIR__ . '/../Helpers/Factories/LojaFisicaFactory.php';
    include_once __DIR__ . '/../Helpers/Factories/LojaVirtualFactory.php';

    class LojaFacade {
        public function realizarCheckout($idUsuario, $metodoPagamento) {
            $carrinhoModel = new Carrinho();
            $produtoModel = new Produto();
            $pagamentoModel = new Pagamento();
            $builder = new PedidoBuilder();

            $itensCarrinho = $carrinhoModel->getItems($idUsuario);

            if (empty($itensCarrinho)) {
                throw new Exception("O carrinho está vazio como o Vácuo.");
            }

            // 1. Construir o Pedido (Builder)
            $builder->setUsuario($idUsuario);
            foreach ($itensCarrinho as $item) {
                // Verifica o preço atualizado do banco (Information Expert)
                $produto = $produtoModel->findById($item['id_produto']);
                if ($produto['estoque'] < $item['quantidade']) {
                    throw new Exception("O artefato '{$produto['nome']}' não possui cópias suficientes.");
                }
                $builder->addItem($produto['id'], $item['quantidade'], $produto['preco']);
            }
            
            $dadosPedido = $builder->build();

            // 2. Processar Pagamento (Factory)
            $dadosPagamento = PagamentoFactory::criarPagamento($metodoPagamento, $dadosPedido['id_pedido'], $dadosPedido['total']);
            $pagamentoModel->registrar($dadosPedido['id_pedido'], $dadosPagamento['metodo'], $dadosPagamento['codigo'], $dadosPagamento['valor'], $dadosPagamento['status']);

            // 3. Atualizar Estoque e Status (State Pattern Concept)
            if ($dadosPagamento['status'] === 'aprovado') {
                $pedidoModel = new Pedido();
                $pedidoModel->updateStatus($dadosPedido['id_pedido'], 'pago');
                
                foreach ($itensCarrinho as $item) {
                    $produtoModel->baixarEstoque($item['id_produto'], $item['quantidade']);
                }
                
                // 4. Limpar Carrinho
                $carrinhoModel->clear($idUsuario);
            }

            return $dadosPedido['id_pedido'];
        }

        public function processarPosPagamento($idPedido, $itensCarrinho, $idUsuario) {
            $produtoModel = new Produto();
            $logModel = new Log();

            foreach ($itensCarrinho as $itemBanco) {
                
                // 1. O Padrão define qual Fábrica usar com base no tipo vindo do banco
                $factory = null;
                if ($itemBanco['tipo'] === 'Físico') {
                    $factory = new LojaFisicaFactory();
                } else {
                    $factory = new LojaVirtualFactory();
                }

                // 2. Cria os objetos usando a Fábrica (Desacoplamento total)
                $produto = $factory->instanciarProduto($itemBanco);
                $entrega = $factory->instanciarProcessadorEntrega();

                // 3. Executa as regras de negócio de acordo com a família do objeto
                if ($produto->precisaBaixarEstoque()) {
                    $produtoModel->baixarEstoque($itemBanco['id_produto'], $itemBanco['quantidade']);
                }

                // 4. Organiza a entrega (seja via correios ou liberação digital)
                $resultadoEntrega = $entrega->organizarEnvio($idPedido, $idUsuario);
                
                // 5. Registra a ação no banco de Logs (RN093)
                $mensagemLog = "Pedido #{$idPedido} - Item: {$produto->getDetalhes()} - Ação: {$resultadoEntrega}";
                $logModel->registrarAcao($idUsuario, $mensagemLog);
            }
        }
    }
?>