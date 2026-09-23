<?php
    // 1. Correção dos caminhos: Voltando dois níveis (../../) a partir da pasta Admin
    require_once __DIR__ . '/../../Model/Pedido.php';
    require_once __DIR__ . '/../../Model/Log.php';
    require_once __DIR__ . '/../../Core/Session.php';

    // Inclusão dos Padrões de Projeto (Singleton e Adapters)
    require_once __DIR__ . '/../../Services/DashboardExportService.php';
    require_once __DIR__ . '/../../Services/Exporters/CsvExportAdapter.php';
    require_once __DIR__ . '/../../Services/Exporters/XmlExportAdapter.php';
    include_once __DIR__ . '/../../Middleware/AuthMiddleware.php';
    include_once __DIR__ . '/../../Middleware/AdminMiddleware.php';

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

        /**
         * NOVO: Carrega a tela de Dashboards/Relatórios
         */
        public function relatorios() {
            include_once __DIR__ . '/../../View/Admin/relatorios.php';
        }

        /**
         * Rota de disparo do download dos relatórios
         */
        public function exportarDashboard() {
            // Coleta o formato desejado (padrão CSV)
            $formato = isset($_GET['formato']) ? strtolower($_GET['formato']) : 'csv';

            // Busca dados brutos no Model (você pode criar um método findAll() no Pedido.php se não existir)
            $pedidoModel = new Pedido();
            $dadosVendas = $pedidoModel->findAll(); 

            // Opcional: Se findAll() retornar vazio, cria um array de teste para não quebrar a exportação
            if (empty($dadosVendas)) {
                $dadosVendas = [
                    ['id' => 1, 'status' => 'Concluído', 'valor' => '150.00', 'data' => date('Y-m-d')],
                    ['id' => 2, 'status' => 'Pendente', 'valor' => '300.00', 'data' => date('Y-m-d')]
                ];
            }

            // Escolhe o Adaptador dinamicamente (Padrão Adapter)
            $adaptador = null;
            if ($formato === 'xml') {
                $adaptador = new XmlExportAdapter();
            } else {
                $adaptador = new CsvExportAdapter();
            }

            // Invoca o Singleton para processar
            $exportService = DashboardExportService::getInstance();
            $relatorio = $exportService->gerarRelatorio($dadosVendas, $adaptador);

            // Força o download
            header("Content-Type: " . $relatorio['content_type']);
            header("Content-Disposition: attachment; filename=\"" . $relatorio['nome_arquivo'] . "\"");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $relatorio['conteudo'];
            exit;
        }

    }
?>