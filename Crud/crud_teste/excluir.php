<?php

// Conectar ao BD
require_once("../conecta.php");

// receber os dados do formulário
$id_usuario = $_GET['id_usuario'];

$sql = "DELETE FROM usuario WHERE id_usuario = $id_usuario";

// executa o comando no BD
mysqli_query($conexao,$sql);

header("location: listar.php");
?>