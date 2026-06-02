<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Guilda {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function create($nome, $descricao, $idLider) {
            try {
                $this->db->beginTransaction();

                // Cria a Guilda
                $stmt = $this->db->prepare("INSERT INTO guildas (nome, descricao, id_lider) VALUES (:nome, :descricao, :id_lider)");
                $stmt->execute(array(
                    'nome' => $nome,
                    'descricao' => $descricao,
                    'id_lider' => $idLider
                ));
                
                $idGuilda = $this->db->lastInsertId();

                // Adiciona o Líder como primeiro membro com o cargo máximo
                $this->addMembro($idGuilda, $idLider, 'Lider');

                $this->db->commit();
                return $idGuilda;
            } catch (Exception $e) {
                $this->db->rollBack();
                return false;
            }
        }

        public function addMembro($idGuilda, $idUsuario, $cargo = 'Membro') {
            $stmt = $this->db->prepare("INSERT INTO guilda_membros (id_guilda, id_usuario, cargo) VALUES (:id_guilda, :id_usuario, :cargo)");
            return $stmt->execute(array(
                'id_guilda' => $idGuilda,
                'id_usuario' => $idUsuario,
                'cargo' => $cargo
            ));
        }

        public function getMembros($idGuilda) {
            $stmt = $this->db->prepare("
                SELECT gm.cargo, gm.joined_at, u.nome_usuario, u.foto_perfil 
                FROM guilda_membros gm
                INNER JOIN usuarios u ON gm.id_usuario = u.id
                WHERE gm.id_guilda = :id_guilda
                ORDER BY gm.cargo DESC, gm.joined_at ASC
            ");
            $stmt->execute(array('id_guilda' => $idGuilda));
            return $stmt->fetchAll();
        }
    }
?>