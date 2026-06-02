<?php
    include_once __DIR__ . '/../IPersonagemAtributos.php';

    class BuffForcaDecorator extends EfeitoDecorator {
        private $bonusForca;

        public function __construct(IPersonagemAtributos $personagem, $bonusForca) {
            parent::__construct($personagem);
            $this->bonusForca = $bonusForca;
        }

        // Altera o comportamento da Força
        public function getForca() {
            return $this->personagem->getForca() + $this->bonusForca;
        }

        // Repassa os outros inalterados
        public function getAgilidade() { return $this->personagem->getAgilidade(); }
        public function getInteligencia() { return $this->personagem->getInteligencia(); }
    }
?>