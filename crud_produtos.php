<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    $sql = "INSERT INTO produtos (nome, descricao, quantidade, preco) VALUES ('$nome', '$descricao', '$quantidade', '$preco')";

    if ($conn->query($sql) === TRUE) {
        echo "Produto adicionado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Produto</title>
</head>
<body>
    <h1>Adicionar Produto</h1>
    <form method="POST">
        Nome: <input type="text" name="nome" required>
        Descrição: <textarea name="descricao" required></textarea>
        Quantidade: <input type="number" name="quantidade" required>
        Preço: <input type="number" step="0.01" name="preco" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>