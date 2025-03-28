<?php
require_once '../../db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Erro ao excluir o produto.";
    }
} else {
    echo "ID do produto não fornecido.";
}
header("Location: ../index.php");
?>