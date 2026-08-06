<?php
    include_once __DIR__ . '/../AbstractLojaFactory.php';

    class EntregaVirtual implements IProcessadorEntrega {
        public function organizarEnvio($idPedido, $idUsuario) {
            // Aqui entraria a lógica de liberar o acesso no banco de dados (ex: mudar a role para Alto Escriba)
            return "Conhecimento liberado na biblioteca do usuário #{$idUsuario} instantaneamente.";
        }
    }
?>