<?php
    include_once __DIR__ . '/../Model/Inventario.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';

    class InventarioController {
        private $inventarioModel;

        public function __construct() {
            AuthMiddleware::check();
            $this->inventarioModel = new Inventario();
        }

        public function index() {
            // Supõe que o ID do personagem em uso está na sessão da campanha atual
            $idPersonagem = Session::get('personagem_ativo_id');
            
            if (!$idPersonagem) {
                Session::set('erro', 'Você precisa incorporar uma alma antes de abrir sua bolsa.');
                header('Location: /personagens');
                exit;
            }

            $itens = $this->inventarioModel->getItens($idPersonagem);
            include_once __DIR__ . '/../View/Personagem/inventario.php';
        }

        public function descartar($postData) {
            $idPersonagem = Session::get('personagem_ativo_id');
            $idItem = (int) $postData['id_item'];
            $quantidade = (int) $postData['quantidade'];

            if ($this->inventarioModel->removerItem($idPersonagem, $idItem, $quantidade)) {
                Session::set('sucesso', 'O artefato foi devolvido ao Vácuo.');
            } else {
                Session::set('erro', 'A magia de descarte falhou.');
            }

            header('Location: /inventario');
            exit;
        }
    }
?>