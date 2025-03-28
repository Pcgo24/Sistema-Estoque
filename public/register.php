<?php
include '../db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $nome_completo = $_POST['nome_completo'] ?? null;
    $cpf = $_POST['cpf'] ?? null;
    $data_nascimento = $_POST['data_nascimento'] ?? null;

    if ($username && $password && $nome_completo && $cpf && $data_nascimento) {
        $sql = "SELECT * FROM usuarios WHERE username = :username OR cpf = :cpf";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['username'] == $username) {
                $error_message = "Username já cadastrado.";
            } elseif ($row['cpf'] == $cpf) {
                $error_message = "CPF já cadastrado.";
            }
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (username, password, nome_completo, cpf, data_nascimento) VALUES (:username, :password, :nome_completo, :cpf, :data_nascimento)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':nome_completo', $nome_completo);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':data_nascimento', $data_nascimento);

            if ($stmt->execute()) {
                $success_message = "Usuário registrado com sucesso!";
                header("Location: login.php");
                exit();
            } else {
                $error_message = "Erro: " . implode(", ", $stmt->errorInfo());
            }
        }
    } else {
        $error_message = "Todos os campos são obrigatórios.";
    }

    // Encerrar a conexão
    $conn = null;
}
?>
<form method="POST">
    Nome Completo: <input type="text" name="nome_completo" value="<?php echo htmlspecialchars($nome_completo ?? ''); ?>" required>
    CPF: <input type="text" name="cpf" value="<?php echo htmlspecialchars($cpf ?? ''); ?>" required>
    Data de Nascimento: <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($data_nascimento ?? ''); ?>" required>
    Username: <input type="text" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
    Password: <input type="password" name="password" value="<?php echo htmlspecialchars($password ?? ''); ?>" required>
    <button type="submit">Registrar</button>
</form>

<?php
if (isset($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
}
if (isset($success_message)) {
    echo "<p style='color: green;'>$success_message</p>";
}
?>