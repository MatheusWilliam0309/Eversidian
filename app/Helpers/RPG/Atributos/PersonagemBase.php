<?php
    include_once __DIR__ . '/../IPersonagemAtributos.php';
    include_once __DIR__ . '/../../../Model/Personagem.php';

    class PersonagemBase implements IPersonagemAtributos {
        private $dadosBanco;

        public function __construct($idPersonagem) {
            $personagemModel = new Personagem();
            // Busca os dados puros do banco (sem buffs)
            $this->dadosBanco = $personagemModel->findById($idPersonagem); 
        }

        public function getForca() { return $this->dadosBanco['forca']; }
        public function getAgilidade() { return $this->dadosBanco['agilidade']; }
        public function getInteligencia() { return $this->dadosBanco['inteligencia']; }
    }
?>