<?php
    include_once __DIR__ . '/../IPersonagemAtributos.php';

    abstract class EfeitoDecorator implements IPersonagemAtributos {
        protected $personagem;

        public function __construct(IPersonagemAtributos $personagem) {
            $this->personagem = $personagem;
        }
    }
?>