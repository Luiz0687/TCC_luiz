<?php

//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

//receber os dados do formulário.
$nome = $_POST['nome'];

//comando sql.
$sql = "INSERT INTO frequencia (nome_projeto) 
VALUES ('$nome')";
mysqli_query($conexao, $sql);
header("location: listar.php");

?>