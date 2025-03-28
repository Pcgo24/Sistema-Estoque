<?php
require_once '../db_connect.php';
require_once '../classes/Usuario.php';
session_start();

$usuario = new Usuario($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($username && $password) {
        if ($row = $usuario->login($username, $password)) {
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Usuário ou senha incorretos.";
        }
    } else {
        $error_message = "Todos os campos são obrigatórios.";
    }

    // Encerrar a conexão
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Estoque</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <header>
        <h1>Login</h1>
        <a href="register.php" class="header-link">Cadastre-se</a>
    </header>

    <div class="container">
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>

        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
    
</body>
</html>