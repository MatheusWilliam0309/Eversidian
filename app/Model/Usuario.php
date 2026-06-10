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

        public function atualizarFotoPerfil($idUsuario, $nomeArquivo) {
            $stmt = $this->db->prepare("UPDATE usuarios SET foto_perfil = :foto_perfil WHERE id = :id");
            return $stmt->execute([
                'foto_perfil' => $nomeArquivo,
                'id' => $idUsuario
            ]);
        }

        public function atualizarDadosPerfil($idUsuario, $nome, $email) {
            $stmt = $this->db->prepare("UPDATE usuarios SET nome_usuario = :nome, email = :email WHERE id = :id");
            return $stmt->execute(['nome' => $nome, 'email' => $email, 'id' => $idUsuario]);
        }

        public function atualizarSenha($idUsuario, $senhaHash) {
            $stmt = $this->db->prepare("UPDATE usuarios SET senha = :senha WHERE id = :id");
            return $stmt->execute(['senha' => $senhaHash, 'id' => $idUsuario]);
        }

        /**
         * Forja um novo Mestre do Vácuo (Admin) diretamente.
         */
        public function createAdmin($nomeUsuario, $email, $senhaHash) {
            $stmt = $this->db->prepare("INSERT INTO usuarios (nome_usuario, email, senha, role, status) VALUES (:nome, :email, :senha, 'gmAdmin', 'ativo')");
            return $stmt->execute([
                'nome' => $nomeUsuario,
                'email' => $email,
                'senha' => $senhaHash
            ]);
        }

        /**
         * Obliterar uma alma do Vácuo (Excluir).
         */
        public function delete($id) {
            try {
                $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
                return $stmt->execute(['id' => $id]);
            } catch (PDOException $e) {
                // Se a alma tiver amarras (personagens, guildas, mensagens), a base de dados relacional (FOREIGN KEY) 
                // vai impedir a exclusão a menos que essas amarras sejam desfeitas primeiro.
                return false; 
            }
        }

        /**
         * Restaura o status do utilizador para ativo e limpa a data de banimento.
         * Utilizado para libertar almas cujo tempo de exílio já expirou.
         */
        public function restaurarStatus($id) {
            $stmt = $this->db->prepare("UPDATE usuarios SET status = 'ativo', banido_ate = NULL WHERE id = :id");
            return $stmt->execute(['id' => $id]);
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