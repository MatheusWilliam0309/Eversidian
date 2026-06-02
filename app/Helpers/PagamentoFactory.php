<?php
    class PagamentoFactory {
        public static function criarPagamento($metodo, $idPedido, $valorTotal) {
            // Simulação de transação
            $codigoTransacao = "TXN_" . strtoupper(uniqid());
            $status = 'aprovado'; // Simulando aprovação automática conforme SDD
            
            if ($metodo === 'pix') {
                // Lógica específica simulada de PIX
                return array('metodo' => 'pix', 'codigo' => $codigoTransacao, 'status' => $status, 'valor' => $valorTotal);
            } else if ($metodo === 'cartao') {
                // Lógica específica simulada de Cartão
                return array('metodo' => 'cartao', 'codigo' => $codigoTransacao, 'status' => $status, 'valor' => $valorTotal);
            }
            
            throw new Exception("Método de pagamento desconhecido pelo Grimório.");
        }
    }
?>