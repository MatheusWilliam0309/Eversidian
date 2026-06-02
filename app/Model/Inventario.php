<?php
    include_once __DIR__ . '/../Core/Database.php';

    class Inventario {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        // Cria o inventário base quando um personagem nasce
        public function create($idPersonagem) {
            $stmt = $this->db->prepare("INSERT INTO inventarios (id_personagem, max_slots) VALUES (:id_personagem, 27)");
            return $stmt->execute(array('id_personagem' => $idPersonagem));
        }

        // Retorna todos os itens que o personagem carrega
        public function getItens($idPersonagem) {
            $stmt = $this->db->prepare("
                SELECT ii.id as id_relacao, ii.quantidade, i.id as id_item, i.nome, i.descricao, i.raridade, i.tipo_item, i.imagem 
                FROM inventario_itens ii
                INNER JOIN inventarios inv ON ii.id_inventario = inv.id
                INNER JOIN itens i ON ii.id_item = i.id
                WHERE inv.id_personagem = :id_personagem
            ");
            $stmt->execute(array('id_personagem' => $idPersonagem));
            return $stmt->fetchAll();
        }

        // Adiciona um item (ou aumenta a quantidade se for empilhável)
        public function addItem($idPersonagem, $idItem, $quantidade) {
            // Primeiro, descobre o ID do inventário do personagem
            $stmtInv = $this->db->prepare("SELECT id FROM inventarios WHERE id_personagem = :id_personagem LIMIT 1");
            $stmtInv->execute(array('id_personagem' => $idPersonagem));
            $inventario = $stmtInv->fetch();

            if (!$inventario) return false;
            $idInventario = $inventario['id'];

            // Verifica se o item já existe no inventário
            $stmtCheck = $this->db->prepare("SELECT id, quantidade FROM inventario_itens WHERE id_inventario = :id_inv AND id_item = :id_item");
            $stmtCheck->execute(array('id_inv' => $idInventario, 'id_item' => $idItem));
            $itemExistente = $stmtCheck->fetch();

            if ($itemExistente) {
                $novaQtd = $itemExistente['quantidade'] + $quantidade;
                $stmtUpdate = $this->db->prepare("UPDATE inventario_itens SET quantidade = :qtd WHERE id = :id");
                return $stmtUpdate->execute(array('qtd' => $novaQtd, 'id' => $itemExistente['id']));
            } else {
                $stmtInsert = $this->db->prepare("INSERT INTO inventario_itens (id_inventario, id_item, quantidade) VALUES (:id_inv, :id_item, :qtd)");
                return $stmtInsert->execute(array('id_inv' => $idInventario, 'id_item' => $idItem, 'qtd' => $quantidade));
            }
        }

        // Consome ou joga fora um item
        public function removerItem($idPersonagem, $idItem, $quantidadeRemover) {
            $stmtInv = $this->db->prepare("SELECT id FROM inventarios WHERE id_personagem = :id_personagem LIMIT 1");
            $stmtInv->execute(array('id_personagem' => $idPersonagem));
            $inventario = $stmtInv->fetch();

            if (!$inventario) return false;

            $stmtCheck = $this->db->prepare("SELECT id, quantidade FROM inventario_itens WHERE id_inventario = :id_inv AND id_item = :id_item");
            $stmtCheck->execute(array('id_inv' => $inventario['id'], 'id_item' => $idItem));
            $item = $stmtCheck->fetch();

            if ($item) {
                if ($item['quantidade'] <= $quantidadeRemover) {
                    $stmtDel = $this->db->prepare("DELETE FROM inventario_itens WHERE id = :id");
                    return $stmtDel->execute(array('id' => $item['id']));
                } else {
                    $stmtUpd = $this->db->prepare("UPDATE inventario_itens SET quantidade = quantidade - :qtd WHERE id = :id");
                    return $stmtUpd->execute(array('qtd' => $quantidadeRemover, 'id' => $item['id']));
                }
            }
            return false;
        }
    }
?>