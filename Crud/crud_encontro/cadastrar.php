<?php

//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

//receber os dados do formulário.
$descricao = $_POST['descricao'];
$horario = $_POST['horario'];
$data = $_POST['data'];
$nome_encontro = $_POST['nome_encontro'];

//comando sql.
$sql = "INSERT INTO encontro (descricao, horario, data, nome_encontro) 
VALUES ('$descricao','$horario','$data','$nome_encontro')";
mysqli_query($conexao, $sql);
//echo $sql;die;
header("location: listar.php");

?>