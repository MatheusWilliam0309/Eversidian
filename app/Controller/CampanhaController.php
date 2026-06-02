<?php
    include_once __DIR__ . '/../Model/Campanha.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';

    class CampanhaController {
        private $campanhaModel;

        public function __construct() {
            // Garante que apenas usuários logados acessem qualquer função de Campanha
            AuthMiddleware::check(); 
            $this->campanhaModel = new Campanha();
        }

        // Exibe a lista de campanhas
        public function index() {
            $listaCampanhas = $this->campanhaModel->findAll();
            // Inclui a View, passando a variável $listaCampanhas implicitamente
            include_once __DIR__ . '/../View/Campanha/index.php';
        }

        // Processa a criação de uma nova campanha via POST
        public function store($postData) {
            $titulo = trim($postData['titulo']);
            $descricao = trim($postData['descricao']);
            $maxJogadores = (int) $postData['max_jogadores'];

            if (empty($titulo)) {
                Session::set('erro', 'O título da campanha não pode estar vazio.');
                header('Location: /campanhas/nova');
                exit;
            }

            $idCampanha = $this->campanhaModel->create($titulo, $descricao, $maxJogadores);

            if ($idCampanha) {
                // Regra RN047 e Controle de Acesso: Quem cria vira o Mestre automaticamente
                // Aqui você chamaria o Model CampanhaParticipantes para vincular o Session::get('user_id') como 'mestre'
                
                Session::set('sucesso', 'Reino forjado com sucesso!');
                header('Location: /campanhas/detalhes?id=' . $idCampanha);
                exit;
            } else {
                Session::set('erro', 'Falha ao conjurar a campanha.');
                header('Location: /campanhas/nova');
                exit;
            }
        }

        // Processa a exclusão de uma campanha
        public function destroy($id) {
            // Aqui deveria ter uma verificação se o Session::get('user_id') é o mestre desta campanha
            if ($this->campanhaModel->delete($id)) {
                Session::set('sucesso', 'Campanha obliterada no vácuo.');
            } else {
                Session::set('erro', 'As amarras mágicas impedem a exclusão desta campanha.');
            }
            header('Location: /campanhas');
            exit;
        }
    }
?>