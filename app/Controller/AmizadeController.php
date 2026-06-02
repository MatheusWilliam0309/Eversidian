<?php
    include_once __DIR__ . '/../Model/Amizade.php';
    include_once __DIR__ . '/../Model/Notificacao.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';

    class AmizadeController {
        private $amizadeModel;

        public function __construct() {
            AuthMiddleware::check();
            $this->amizadeModel = new Amizade();
        }

        public function enviarConvite($postData) {
            $idUsuario = Session::get('user_id');
            $idAmigo = (int) $postData['id_amigo'];

            if ($this->amizadeModel->sendRequest($idUsuario, $idAmigo)) {
                // Cria uma notificação para o usuário que recebeu o convite
                $notificacaoModel = new Notificacao();
                $nomeRemetente = Session::get('user_name');
                $notificacaoModel->create($idAmigo, "Novo pacto de aliança", "O escriba {$nomeRemetente} deseja forjar uma aliança com você.");

                Session::set('sucesso', 'O corvo foi enviado com seu convite.');
            } else {
                Session::set('erro', 'A aliança não pode ser forjada no momento.');
            }

            header('Location: /comunidade');
            exit;
        }

        public function responderConvite($postData) {
            $idUsuario = Session::get('user_id');
            $idAmizade = (int) $postData['id_amizade'];
            $resposta = $postData['resposta'] === 'aceitar' ? 'Aceito' : 'Rejeitado';

            if ($this->amizadeModel->updateStatus($idAmizade, $idUsuario, $resposta)) {
                Session::set('sucesso', "O convite foi {$resposta}.");
            }

            header('Location: /notificacoes');
            exit;
        }
    }
?>