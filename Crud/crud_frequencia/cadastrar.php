<?php

//conectar ao banco de dados.
require_once("../conecta.php");

//receber os dados do formulário.
$nome = $_POST['nome'];

//comando sql.
$sql = "INSERT INTO projeto (nome_projeto) 
VALUES ('$nome')";
mysqli_query($conexao, $sql);
header("location: listar.php");

?>