<?php

// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();

// receber os dados do formulário
$id_encontro = $_GET['id_encontro'];

$sql = "DELETE FROM encontro WHERE id_encontro = $id_encontro";

// executa o comando no BD
mysqli_query($conexao,$sql);

header("location: listar.php");
?>