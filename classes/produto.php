<?php

class Produto {

        private $conn;
        private $table = 'produtos';

        public function __construct($db) {
            $this->conn = $db -> getConnection();
        }

        public function listar_produtos() {
            $sql = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function cadastrar_produto ($nome, $descricao, $quantidade, $preco) {
            $sql = "INSERT INTO " . $this->table . " (nome, descricao, quantidade, preco) VALUES (:nome, :descricao, :quantidade, :preco)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':preco', $preco);
            return $stmt->execute();
        }

        public function editar_produto ($id, $nome, $descricao, $quantidade, $preco) {
            $sql = "UPDATE " . $this->table . " SET nome = :nome, descricao = :descricao, quantidade = :quantidade, preco = :preco WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':preco', $preco);
            return $stmt->execute();
        }

        public function excluir_produto ($id) {
            $sql = "DELETE * FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }

    }
?>