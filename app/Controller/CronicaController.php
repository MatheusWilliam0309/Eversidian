<?php
    include_once __DIR__ . '/../Model/Cronica.php';

    class CronicaController {
        private $cronicaModel;

        public function __construct() {
            $this->cronicaModel = new Cronica();
        }

        // Exibe as crônicas do sistema para todos os usuários
        public function index() {
            $posts = $this->cronicaModel->findSistemaCronicas();
            include_once __DIR__ . '/../View/Cronica/index.php';
        }

        // Exibe as crônicas de uma campanha específica
        public function campanha($idCampanha) {
            $posts = $this->cronicaModel->findCampanhaCronicas($idCampanha);
            include_once __DIR__ . '/../View/Cronica/campanha.php';
        }
    }
?>