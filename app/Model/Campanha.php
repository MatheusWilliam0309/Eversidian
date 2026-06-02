<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Campanha {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        // [CREATE] Cria uma nova campanha
        public function create($titulo, $descricao, $maxJogadores) {
            $stmt = $this->db->prepare("INSERT INTO campanhas (titulo, descricao, max_jogadores, status) VALUES (:titulo, :descricao, :max_jogadores, 'aberto')");
            
            $stmt->execute(array(
                'titulo' => $titulo,
                'descricao' => $descricao,
                'max_jogadores' => $maxJogadores
            ));

            return $this->db->lastInsertId(); // Retorna o ID da campanha recém-criada
        }

        // [READ] Busca todas as campanhas (para a tela inicial de Campanhas)
        public function findAll() {
            $stmt = $this->db->query("SELECT * FROM campanhas ORDER BY created_at DESC");
            return $stmt->fetchAll();
        }

        // [READ] Busca uma campanha específica pelo ID
        public function findById($id) {
            $stmt = $this->db->prepare("SELECT * FROM campanhas WHERE id = :id LIMIT 1");
            $stmt->execute(array('id' => $id));
            
            $campanha = $stmt->fetch();
            return $campanha ? $campanha : null;
        }

        // [UPDATE] Atualiza os dados de uma campanha
        public function update($id, $titulo, $descricao, $maxJogadores, $status) {
            $stmt = $this->db->prepare("UPDATE campanhas SET titulo = :titulo, descricao = :descricao, max_jogadores = :max_jogadores, status = :status WHERE id = :id");
            
            return $stmt->execute(array(
                'titulo' => $titulo,
                'descricao' => $descricao,
                'max_jogadores' => $maxJogadores,
                'status' => $status,
                'id' => $id
            ));
        }

        // [DELETE] Remove uma campanha (Nota: Em produção, o ideal é Soft Delete mudando o status)
        public function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM campanhas WHERE id = :id");
            return $stmt->execute(array('id' => $id));
        }
    }
?>