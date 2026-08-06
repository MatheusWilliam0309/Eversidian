<?php
    include_once __DIR__ . '/../AbstractLojaFactory.php';

    class EntregaFisica implements IProcessadorEntrega {
        public function organizarEnvio($idPedido, $idUsuario) {
            // Aqui entraria a lógica de gerar etiqueta de Correios/Transportadora
            return "Preparando pacote de envio para o pedido #{$idPedido}. A caravana partirá em breve.";
        }
    }
?>