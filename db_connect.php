<?php

require_once 'classes/database.php';

$servername = 'localhost:3306';
$username = 'root';
$password = '';
$dbname = 'sistema_estoque';

try {
    $db = new DataBase($servername, $username, $password, $dbname);
    $conn = $db->getConnection();
} catch (PDOException $e) {
    die ("Falha na conexão com o banco de dados: " . $e -> getMessage());
}

?>