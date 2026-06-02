<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Carrinho {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        private function getOrCreateCart($idUsuario) { //Procura o "dono" do carrinho
            $stmt = $this->db->prepare("SELECT id FROM carrinho WHERE id_usuario = :id_usuario LIMIT 1");
            $stmt->execute(array('id_usuario' => $idUsuario));
            $carrinho = $stmt->fetch();

            if ($carrinho) {
                return $carrinho['id'];
            }

            $stmtInsert = $this->db->prepare("INSERT INTO carrinho (id_usuario) VALUES (:id_usuario)");
            $stmtInsert->execute(array('id_usuario' => $idUsuario));
            return $this->db->lastInsertId();
        }

        public function add($idUsuario, $idProduto, $quantidade) {
            $idCarrinho = $this->getOrCreateCart($idUsuario);

            // Verifica se item já existe para atualizar quantidade
            $stmtCheck = $this->db->prepare("SELECT id, quantidade FROM carrinho_itens WHERE id_carrinho = :id_carrinho AND id_produto = :id_produto");
            $stmtCheck->execute(array('id_carrinho' => $idCarrinho, 'id_produto' => $idProduto));
            $item = $stmtCheck->fetch();

            if ($item) {
                $novaQtd = $item['quantidade'] + $quantidade;
                $stmtUpdate = $this->db->prepare("UPDATE carrinho_itens SET quantidade = :qtd WHERE id = :id");
                return $stmtUpdate->execute(array('qtd' => $novaQtd, 'id' => $item['id']));
            } else {
                $stmtInsert = $this->db->prepare("INSERT INTO carrinho_itens (id_carrinho, id_produto, quantidade) VALUES (:id_carrinho, :id_produto, :qtd)");
                return $stmtInsert->execute(array('id_carrinho' => $idCarrinho, 'id_produto' => $idProduto, 'qtd' => $quantidade));
            }
        }

        public function getItems($idUsuario) { //Salva os itens adicionados no carrinho do usuário.
            $stmt = $this->db->prepare("
                SELECT ci.*, p.nome, p.preco, p.imagem 
                FROM carrinho_itens ci
                INNER JOIN carrinho c ON ci.id_carrinho = c.id
                INNER JOIN produtos p ON ci.id_produto = p.id
                WHERE c.id_usuario = :id_usuario
            ");
            $stmt->execute(array('id_usuario' => $idUsuario));
            return $stmt->fetchAll();
        }

        public function clear($idUsuario) {
            $idCarrinho = $this->getOrCreateCart($idUsuario);
            $stmt = $this->db->prepare("DELETE FROM carrinho_itens WHERE id_carrinho = :id_carrinho");
            return $stmt->execute(array('id_carrinho' => $idCarrinho));
        }
    }
?>