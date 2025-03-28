<?php
require_once '../db_connect.php';

$id = $_GET['id'];
$conn->query("DELETE FROM produtos WHERE id = $id");
header("Location: listar.php");
?>