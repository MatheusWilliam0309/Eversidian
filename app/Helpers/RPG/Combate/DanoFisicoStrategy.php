<?php
    include_once __DIR__ . '/../IEstrategiaDano.php';

    class DanoFisicoStrategy implements IEstrategiaDano {
        public function calcularDano($atributosAtacante, $atributosDefensor, $poderDaArma) {
            // Dano Físico = (Força + Poder da Arma) - (Agilidade/2 + Defesa)
            $ataqueBase = $atributosAtacante['forca'] + $poderDaArma;
            $defesaBase = ($atributosDefensor['agilidade'] / 2) + (isset($atributosDefensor['defesa']) ? $atributosDefensor['defesa'] : 0);
            
            $dano = $ataqueBase - $defesaBase;
            return $dano > 0 ? (int) $dano : 1; // Mínimo de 1 de dano
        }
    }
?>