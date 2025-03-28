<?php
require_once '../db_connect.php'; // Caminho ajustado para incluir o arquivo corretamente
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
<form method="POST">
    Username: <input type="text" name="username" required>
    Password: <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>

<?php
if (isset($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
}
?>