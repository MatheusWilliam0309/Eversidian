<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Usuario {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function findByEmail($email) {
            $stmt = $this->db->prepare("SELECT id, nome_usuario, email, senha, role, status, banido_ate FROM usuarios WHERE email = :email LIMIT 1");
            $stmt->execute(array('email' => $email));
            
            $usuario = $stmt->fetch();
            return $usuario ? $usuario : null;
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

        public function create($nomeUsuario, $email, $senha) {
            // Criptografia irreversível da senha (RN004)
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            
            $stmt = $this->db->prepare("INSERT INTO usuarios (nome_usuario, email, senha) VALUES (:nome, :email, :senha)"); //
            
            return $stmt->execute(array(
                'nome'  => $nomeUsuario,
                'email' => $email,
                'senha' => $senhaHash
            ));
        }
    }
?>