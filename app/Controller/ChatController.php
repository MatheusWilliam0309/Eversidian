<?php
    include_once __DIR__ . '/../Model/Mensagem.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';

    class ChatController {
        private $mensagemModel;

        public function __construct() {
            AuthMiddleware::check();
            $this->mensagemModel = new Mensagem();
        }

        /**
         * Endpoint HTTP de fallback ou para salvar logs do WebSocket
         */
        public function enviarMensagemCampanha($postData) {
            $idRemetente = Session::get('user_id');
            $idCampanha = (int) $postData['id_campanha'];
            $texto = trim($postData['mensagem']);

            if (!empty($texto)) {
                $this->mensagemModel->saveCampaignMessage($idRemetente, $idCampanha, $texto);
            }
            
            // Em um fluxo com WebSocket, isso poderia retornar um JSON (API)
            header("Location: /campanhas/jogar?id={$idCampanha}");
            exit;
        }

        public function processarMensagem($postData) {
            $mensagem = trim($postData['mensagem']);
            $idCampanha = (int) $postData['id_campanha'];
            
            // Verifica se é um comando de rolagem
            if (strpos($mensagem, '/roll ') === 0) {
                $expressao = substr($mensagem, 6); // Remove a palavra '/roll '
                
                $rolagemService = new RolagemService();
                $resultado = $rolagemService->rolarDado($expressao);
                
                if ($resultado) {
                    // Salva a rolagem como uma mensagem do sistema no banco
                    $this->mensagemModel->saveCampaignMessage(Session::get('user_id'), $idCampanha, $resultado['mensagem']);
                } else {
                    Session::set('erro', 'Os Deuses não reconhecem esse formato de dado.');
                }
            } else {
                // É apenas uma mensagem de texto normal de RP (Roleplay)
                $this->mensagemModel->saveCampaignMessage(Session::get('user_id'), $idCampanha, $mensagem);
            }
            
            header("Location: /campanhas/jogar?id={$idCampanha}");
            exit;
        }
    }
?>