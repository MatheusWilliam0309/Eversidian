<?php
    include_once __DIR__ . '/../IEstrategiaDano.php';

    class DanoMagicoStrategy implements IEstrategiaDano {
        public function calcularDano($atributosAtacante, $atributosDefensor, $poderDaMagia) {
            // Dano Mágico ignora armadura física, baseia-se na Inteligência
            $ataqueBase = $atributosAtacante['inteligencia'] + $poderDaMagia;
            $resistenciaMagica = $atributosDefensor['inteligencia'] / 1.5;
            
            $dano = $ataqueBase - $resistenciaMagica;
            return $dano > 0 ? (int) $dano : 1;
        }
    }
?>