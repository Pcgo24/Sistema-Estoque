<?php
require_once '../db_connect.php';

// Busca produto
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM produtos WHERE id = $id");
$produto = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    $sql = "UPDATE produtos SET 
            nome='$nome', 
            descricao='$descricao', 
            quantidade=$quantidade, 
            preco=$preco 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar.php");
    }
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $produto['nome'] ?>" required><br>
    Descrição: <textarea name="descricao"><?= $produto['descricao'] ?></textarea><br>
    Quantidade: <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" required><br>
    Preço: <input type="text" name="preco" value="<?= $produto['preco'] ?>" required><br>
    <button type="submit">Salvar</button>
</form>