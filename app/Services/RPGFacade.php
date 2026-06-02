<?php
    include_once __DIR__ . '/../Model/Personagem.php';
    include_once __DIR__ . '/../Model/Npc.php'; // Suposto model CRUD de NPCs
    include_once __DIR__ . '/../Helpers/RPG/Atributos/PersonagemBase.php';
    include_once __DIR__ . '/../Helpers/RPG/Atributos/BuffForcaDecorator.php';
    include_once __DIR__ . '/../Helpers/RPG/Combate/DanoFisicoStrategy.php';
    include_once __DIR__ . '/../Helpers/RPG/Combate/DanoMagicoStrategy.php';

    class RPGFacade {
        
        public function resolverAtaque($idAtacante, $idDefensorNpc, $tipoAtaque, $poderArmaOuMagia) {
            // 1. Instancia a base do personagem
            $atacante = new PersonagemBase($idAtacante);

            // (Exemplo): Busca no banco efeitos ativos. Se houver feitiço de força ativo, aplica o Decorator.
            // Aqui assumimos que ele tem um Buff de +5 de Força ativado.
            $atacanteComBuffs = new BuffForcaDecorator($atacante, 5);

            $npcModel = new Npc();
            $defensor = $npcModel->findById($idDefensorNpc); // Retorna array com atributos do NPC

            // 2. Transforma os atributos decorados em array para enviar para a Strategy
            $atributosFinalAtacante = array(
                'forca' => $atacanteComBuffs->getForca(),
                'agilidade' => $atacanteComBuffs->getAgilidade(),
                'inteligencia' => $atacanteComBuffs->getInteligencia()
            );

            // 3. Define a Estratégia de Combate dinamicamente
            $estrategia = null;
            if ($tipoAtaque === 'fisico') {
                $estrategia = new DanoFisicoStrategy();
            } else {
                $estrategia = new DanoMagicoStrategy();
            }

            // 4. Calcula o dano final
            $danoCausado = $estrategia->calcularDano($atributosFinalAtacante, $defensor, $poderArmaOuMagia);

            // 5. Aplica o dano no banco
            $vidaRestante = $defensor['vida'] - $danoCausado;
            $npcModel->updateVida($idDefensorNpc, $vidaRestante);

            return array(
                'dano' => $danoCausado,
                'vida_restante' => $vidaRestante,
                'mensagem' => "Um golpe desferiu {$danoCausado} de dano contra as trevas."
            );
        }
    }
?>