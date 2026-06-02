<?php
    class RolagemService {
        
        /**
         * Interpreta e calcula uma rolagem de dados.
         * Exemplo de entrada: "2d6+3", "1d20-1", "1d100"
         */
        public function rolarDado($expressao) {
            // Limpa espaços em branco da string
            $expressao = str_replace(' ', '', strtolower($expressao));
            
            // Expressão Regular para capturar: [quantidade] d [lados] [sinal] [modificador]
            // Ex: Captura "2", "6", "+", "3" de "2d6+3"
            $padrao = '/^(\d+)d(\d+)(?:([\+\-])(\d+))?$/';
            
            if (!preg_match($padrao, $expressao, $matches)) {
                return false; // Expressão inválida
            }

            $quantidade = (int) $matches[1];
            $lados = (int) $matches[2];
            $sinal = isset($matches[3]) ? $matches[3] : null;
            $modificador = isset($matches[4]) ? (int) $matches[4] : 0;

            // Validação de segurança básica para não travar o servidor com "99999d99999"
            if ($quantidade > 100 || $quantidade < 1 || $lados < 2 || $lados > 100) {
                return false; 
            }

            $dadosRolados = array();
            $somaDados = 0;

            // Rola os dados de forma segura utilizando random_int() nativo do PHP
            for ($i = 0; $i < $quantidade; $i++) {
                $resultadoDado = random_int(1, $lados);
                $dadosRolados[] = $resultadoDado;
                $somaDados += $resultadoDado;
            }

            // Aplica o modificador (+ ou -)
            $totalFinal = $somaDados;
            if ($sinal === '+') {
                $totalFinal += $modificador;
            } else if ($sinal === '-') {
                $totalFinal -= $modificador;
            }

            // Formata a resposta textual detalhada para o chat
            $textoRolagens = implode(', ', $dadosRolados);
            $textoModificador = $modificador > 0 ? " {$sinal} {$modificador}" : "";
            
            $mensagemFinal = "Rolou **{$expressao}**\n";
            $mensagemFinal .= "Dados: [{$textoRolagens}]{$textoModificador}\n";
            $mensagemFinal .= "Resultado: **{$totalFinal}**";

            return array(
                'expressao' => $expressao,
                'dados' => $dadosRolados,
                'total' => $totalFinal,
                'mensagem' => $mensagemFinal
            );
        }
    }
?>