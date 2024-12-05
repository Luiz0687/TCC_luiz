<?php

//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

//receber os dados do formulário.
$nome = $_POST['nome_projeto'];
$situacao = $_POST['situacao'];

//comando sql.
$sql = "INSERT INTO projeto (nome_projeto, situacao) 
VALUES ('$nome', '$situacao')";
mysqli_query($conexao, $sql);
header("location: listar.php");

?>