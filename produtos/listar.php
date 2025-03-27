<?php
require_once '../db_connect.php';

$result = $conn->query("SELECT * FROM produtos");
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Quantidade</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nome'] ?></td>
        <td><?= $row['descricao'] ?></td>
        <td><?= $row['quantidade'] ?></td>
        <td>R$ <?= $row['preco'] ?></td>
        <td>
            <a href="editar.php?id=<?= $row['id'] ?>">Editar</a>
            <a href="excluir.php?id=<?= $row['id'] ?>">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="cadastrar.php">Novo produto</a>