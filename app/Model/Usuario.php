<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Usuario {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function findByEmail($email) {
            $stmt = $this->db->prepare("SELECT id, nome_usuario, email, senha, role, status FROM usuarios WHERE email = :email LIMIT 1");
            $stmt->execute(array('email' => $email));
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * Encontra um utilizador pelo seu ID único.
         */
        public function findById($id) {
            $stmt = $this->db->prepare("SELECT id, nome_usuario, email, role, status, created_at FROM usuarios WHERE id = :id LIMIT 1");
            $stmt->execute(array('id' => $id));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function create($nomeUsuario, $email, $senhaHash) {
            $stmt = $this->db->prepare("INSERT INTO usuarios (nome_usuario, email, senha, role, status) VALUES (:nome, :email, :senha, 'jogador', 'ativo')");
            
            return $stmt->execute(array(
                'nome' => $nomeUsuario,
                'email' => $email,
                'senha' => $senhaHash
            ));
        }

        /**
         * Atualiza o nome e o e-mail do utilizador.
         */
        public function update($id, $nome, $email) {
            $stmt = $this->db->prepare("UPDATE usuarios SET nome_usuario = :nome, email = :email WHERE id = :id");
            return $stmt->execute(array(
                'nome' => $nome,
                'email' => $email,
                'id' => $id
            ));
        }

        // Novo método para o sistema perdoar a alma automaticamente
        public function revogarBanimento($id) {
            $stmt = $this->db->prepare("UPDATE usuarios SET status = 'ativo', banido_ate = NULL WHERE id = :id");
            return $stmt->execute(array('id' => $id));
        }

        /**
         * Verifica se já existe algum escriba com o mesmo nome ou email.
         */
        public function checkExists($email, $nomeUsuario) {
            $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE email = :email OR nome_usuario = :nome LIMIT 1");
            $stmt->execute(array(
                'email' => $email,
                'nome' => $nomeUsuario
            ));
            
            return $stmt->fetch() ? true : false;
        }
    }
?>