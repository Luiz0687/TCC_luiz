<?php

// Conectar ao BD
require_once("../conecta.php");

// receber os dados do formulário
$id_horario = $_GET['id_horario'];

$sql = "DELETE FROM horario WHERE id_horario = $id_horario";

// executa o comando no BD
mysqli_query($conexao,$sql);

header("location: listar.php");
?>