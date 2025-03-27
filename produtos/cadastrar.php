<?php
require_once '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    $sql = "INSERT INTO produtos (nome, descricao, quantidade, preco) 
            VALUES ('$nome', '$descricao', $quantidade, $preco)";

    if ($conn->query($sql) === TRUE) {
        echo "Produto cadastrado!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" required><br>
    Descrição: <textarea name="descricao"></textarea><br>
    Quantidade: <input type="number" name="quantidade" required><br>
    Preço: <input type="text" name="preco" required><br>
    <button type="submit">Cadastrar</button>
</form>
<a href="listar.php">Ver produtos</a>