<?php
    include_once __DIR__ . '/../Model/Personagem.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';

    class PersonagemController {
        private $personagemModel;

        public function __construct() {
            AuthMiddleware::check();
            $this->personagemModel = new Personagem();
        }

        // Lista os personagens do usuário logado
        public function index() {
            $idUsuario = Session::get('user_id');
            $listaPersonagens = $this->personagemModel->findByUsuario($idUsuario);
            
            include_once __DIR__ . '/../View/Personagem/index.php';
        }

        // Processa a criação
        public function store($postData) {
            $nome = trim($postData['nome']);
            $idRaca = (int) $postData['id_raca'];
            $idClasse = (int) $postData['id_classe'];
            $idUsuario = Session::get('user_id');

            if (empty($nome) || $idRaca <= 0 || $idClasse <= 0) {
                Session::set('erro', 'Todos os pactos devem ser preenchidos para criar uma alma.');
                header('Location: /personagens/novo');
                exit;
            }

            if ($this->personagemModel->create($idUsuario, $idRaca, $idClasse, $nome)) {
                Session::set('sucesso', 'Personagem forjado. O destino aguarda.');
                header('Location: /personagens');
                exit;
            } else {
                Session::set('erro', 'Houve um distúrbio na conjuração.');
                header('Location: /personagens/novo');
                exit;
            }
        }
    }
?>