<?php
    include_once __DIR__ . '/../Services/RPGFacade.php';
    include_once __DIR__ . '/../Model/Mensagem.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';

    class SessaoRPGController {
        
        public function __construct() {
            AuthMiddleware::check();
        }

        public function atacarNpc($postData) {
            $idPersonagem = Session::get('personagem_ativo_id');
            $idNpc = (int) $postData['id_npc'];
            $tipoAtaque = $postData['tipo_ataque']; // 'fisico' ou 'magico'
            $poderAtk = (int) $postData['poder_habilidade']; // Valor vindo do item equipado
            $idCampanha = (int) $postData['id_campanha'];

            $facade = new RPGFacade();
            $resultado = $facade->resolverAtaque($idPersonagem, $idNpc, $tipoAtaque, $poderAtk);

            // Registra o evento de batalha no Chat da Campanha para todos lerem
            $mensagemModel = new Mensagem();
            $nomePersonagem = Session::get('personagem_ativo_nome');
            $textoLog = "[SISTEMA DE COMBATE]: {$nomePersonagem} atacou. " . $resultado['mensagem'];
            
            $mensagemModel->saveCampaignMessage(Session::get('user_id'), $idCampanha, $textoLog);

            Session::set('sucesso', $resultado['mensagem']);
            header("Location: /campanhas/jogar?id={$idCampanha}");
            exit;
        }
    }
?>