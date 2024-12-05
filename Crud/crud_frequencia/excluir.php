<?php

// Conectar ao BD
require_once("../conecta.php");

// receber os dados do formulário
$id_projeto= $_GET['id_projeto'];

$sql = "DELETE FROM projeto WHERE id_projeto = $id_projeto";

// executa o comando no BD
mysqli_query($conexao,$sql);

header("location: listar.php");
?>