<?php
    include_once __DIR__ . '/../Model/Pedido.php';
    include_once __DIR__ . '/../Model/Log.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';
    include_once __DIR__ . '/../Middleware/AdminMiddleware.php';

    class AdminPedidoController {
        private $pedidoModel;
        private $logModel;

        public function __construct() {
            AuthMiddleware::check();
            AdminMiddleware::check();
            
            $this->pedidoModel = new Pedido();
            $this->logModel = new Log();
        }

        // Altera o status do pedido (ex: de 'pago' para 'enviado' ou 'cancelado')
        public function atualizarStatus($idPedido, $novoStatus) {
            $idUsuario = Session::get('user_id');

            // Validação de segurança básica para os status permitidos
            $statusPermitidos = array('pendente', 'pago', 'cancelado', 'enviado', 'finalizado');
            
            if (!in_array(strtolower($novoStatus), $statusPermitidos)) {
                Session::set('erro', 'Status inválido nas leis do Vácuo.');
                header("Location: /admin/pedidos/ver?id={$idPedido}");
                exit;
            }

            if ($this->pedidoModel->updateStatus($idPedido, $novoStatus)) {
                $this->logModel->registrarAcao($idUsuario, "Alterou o status do pedido #{$idPedido} para {$novoStatus}");
                Session::set('sucesso', "Status do pedido #{$idPedido} atualizado para {$novoStatus}.");
            } else {
                Session::set('erro', 'Falha ao atualizar o selo do pedido.');
            }

            header("Location: /admin/pedidos/ver?id={$idPedido}");
            exit;
        }
    }
?>