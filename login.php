<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password']))
        {
            $_SESSION['username'] = $username;
            header ("Location: index.php");
            exit();
        }else 
        {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
        

    $conn->close();
}
?>
<form method="POST">
    Username: <input type="text" name="username" required>
    Password: <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>