<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "sistema_estoque";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Falha de conexão: " . $conn->connect_error);
}
?>