<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nome_completo = $_POST['nome_completo'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];


    $sql = "INSERT INTO usuarios (username, password, nome_completo, cpf, data_nascimento) VALUES ('$username', '$password', '$nome_completo', '$cpf', '$data_nascimento')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuário registrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<form method="POST">
    Nome Completo: <input type="text" name="nome_completo" required>
    CPF: <input type="text" name="cpf" required>
    Data de Nascimento: <input type="date" name="data_nascimento" required>
    Username: <input type="text" name="username" required>
    Password: <input type="password" name="password" required>
    <button type="submit">Registrar</button>
</form>