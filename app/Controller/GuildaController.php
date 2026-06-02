<?php
    include_once __DIR__ . '/../Model/Guilda.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';

    class GuildaController {
        private $guildaModel;

        public function __construct() {
            AuthMiddleware::check();
            $this->guildaModel = new Guilda();
        }

        public function store($postData) {
            $nome = trim($postData['nome']);
            $descricao = trim($postData['descricao']);
            $idLider = Session::get('user_id');

            if (empty($nome)) {
                Session::set('erro', 'O estandarte precisa de um nome.');
                header('Location: /guildas/nova');
                exit;
            }

            $idGuilda = $this->guildaModel->create($nome, $descricao, $idLider);

            if ($idGuilda) {
                Session::set('sucesso', 'Sua facção ergueu as bandeiras no Vácuo.');
                header("Location: /guildas/ver?id={$idGuilda}");
            } else {
                Session::set('erro', 'Falha ao forjar a guilda. Este nome já pode estar gravado nas pedras (Nome em uso).');
                header('Location: /guildas/nova');
            }
            exit;
        }
    }
?>