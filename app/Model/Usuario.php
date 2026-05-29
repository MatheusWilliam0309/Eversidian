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
            
            $usuario = $stmt->fetch();
            return $usuario ? $usuario : null;
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