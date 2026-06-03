<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Cronica {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        // Busca crônicas globais do sistema
        public function findSistemaCronicas() {
            $stmt = $this->db->query("
                SELECT c.*, u.nome_usuario 
                FROM cronicas c
                INNER JOIN usuarios u ON c.id_autor = u.id
                WHERE c.id_campanha IS NULL
                ORDER BY c.created_at DESC
            ");
            return $stmt->fetchAll();
        }

        // Busca crônicas específicas de uma campanha
        public function findCampanhaCronicas($idCampanha) {
            $stmt = $this->db->prepare("
                SELECT c.*, u.nome_usuario 
                FROM cronicas c
                INNER JOIN usuarios u ON c.id_autor = u.id
                WHERE c.id_campanha = :id_campanha
                ORDER BY c.created_at DESC
            ");
            $stmt->execute(array('id_campanha' => $idCampanha));
            return $stmt->fetchAll();
        }

        public function create($idAutor, $idCampanha, $titulo, $categoria, $resumo, $conteudo) {
            $stmt = $this->db->prepare("
                INSERT INTO cronicas (id_autor, id_campanha, titulo, categoria, resumo, conteudo) 
                VALUES (:autor, :campanha, :titulo, :categoria, :resumo, :conteudo)
            ");
            return $stmt->execute(array(
                'autor' => $idAutor,
                'campanha' => $idCampanha,
                'titulo' => $titulo,
                'categoria' => $categoria,
                'resumo' => $resumo,
                'conteudo' => $conteudo
            ));
        }
    }
?>