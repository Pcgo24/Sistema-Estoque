<?php

class Produto {
    private $conn;
    private $table = 'produtos';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($nome, $descricao, $quantidade, $preco) {
        $sql = "INSERT INTO " . $this->table . " (nome, descricao, quantidade, preco) VALUES (:nome, :descricao, :quantidade, :preco)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':preco', $preco);
        
        return $stmt->execute();
    }
}
?>