<?php
include 'db_connect.php';

$username = '';
$password = '';
$nome_completo = '';
$cpf = '';
$data_nascimento = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nome_completo = $_POST['nome_completo'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];


    $sql = "SELECT * FROM usuarios WHERE username='$username' OR cpf='$cpf'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row ['username'] == $username) {
            $error_message = "Username já cadastrado.";
        } elseif ($row ['cpf'] == $cpf) {
            $error_message = "CPF já cadastrado.";
        }
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (username, password, nome_completo, cpf, data_nascimento) VALUES ('$username', '$hashed_password', '$nome_completo', '$cpf', '$data_nascimento')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Usuário registrado com sucesso!";
            header("Location: login.php");
    
        } else {
            $error_message = "Erro: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
<form method="POST">
    Nome Completo: <input type="text" name="nome_completo" value="<?php echo htmlspecialchars($nome_completo); ?>" required>
    CPF: <input type="text" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" required>
    Data de Nascimento: <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($data_nascimento); ?>" required>
    Username: <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
    Password: <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
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