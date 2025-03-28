<?php

require_once '../db_connect.php';
require_once '../classes/produto.php';

session_start();

$produto = new Produto($db);

$action = $_GET['action'] ?? 'listar_produtos';
$id = $_GET['id'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? 'listar_produtos';
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $quantidade = $_POST['quantidade'] ?? null;
    $preco = $_POST['preco'] ?? null;

    if ($action == 'cadastrar_produto' && $nome && $descricao && $quantidade && $preco) {
        if ($produto->cadastrar_produto($nome, $descricao, $quantidade, $preco)) {
            $success_message = "Produto cadastrado com sucesso!";
        } else {
            $error_message = "Erro ao cadastrar o produto.";
        }
    } elseif ($action == 'editar_produto' && $id && $nome && $descricao && $quantidade && $preco) {
        if ($produto->editar_produto($id, $nome, $descricao, $quantidade, $preco)) {
            $success_message = "Produto editado com sucesso!";
        } else {
            $error_message = "Erro ao editar o produto.";
        }
    } elseif ($action == 'excluir_produto' && $id) {
        var_dump($id); // Debugging: Verifica o ID
        if ($produto->excluir_produto($id)) {
            $success_message = "Produto excluído com sucesso!";
            header("Location: index.php"); // Redireciona após a exclusão
            exit;
        } else {
            $error_message = "Erro ao excluir o produto.";
        }
    }
}

$produtos = $produto->listar_produtos();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de estoque</title>
</head>
<body>

    <h1>Sistema de estoque</h1>

    <?php if ($action == 'listar_produtos' || $action == 'excluir_produto'): ?>

    <h2>Lista de Produtos</h2>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?php echo $produto['id']; ?></td>
            <td><?php echo $produto['nome']; ?></td>
            <td><?php echo $produto['descricao']; ?></td>
            <td><?php echo $produto['quantidade']; ?></td>
            <td><?php echo $produto['preco']; ?></td>
            <td>
                <a href="?action=editar_produto&id=<?php echo $produto['id']; ?>">Editar</a>
                <a href="produtos/excluir.php?id=<?php echo $produto['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="?action=cadastrar_produto">Cadastrar novo produto</a>

    <?php endif; ?>

    <?php if ($action == 'cadastrar_produto' || $action == 'editar_produto'): 
        
        $produtoData = ['nome' => '', 'descricao' => '', 'quantidade' => '', 'preco' => ''];

        if ($action == 'editar_produto' && $id) {
            $produtoData = $produto->listar_produtos($id)[0];
        }

    ?>

    <h2><?php echo ucfirst($action); ?> Produto</h2>

    <form method="POST">
        <input type="hidden" name="action" value="<?php echo $action; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        Nome: <input type="text" name="nome" value="<?php echo $produtoData['nome']; ?>" required>
        Descrição: <input type="text" name="descricao" value="<?php echo $produtoData['descricao']; ?>" required>
        Quantidade: <input type="number" name="quantidade" value="<?php echo $produtoData['quantidade']; ?>" required>
        Preço: <input type="number" name="preco" value="<?php echo $produtoData['preco']; ?>" required>
        <button type="submit"><?php echo ucfirst($action); ?> Produto</button>
    </form>

    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>  
    <?php endif; ?>

    <?php if (isset($success_message)): ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
    
</body>
</html>