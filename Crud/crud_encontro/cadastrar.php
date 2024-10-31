<?php

//conectar ao banco de dados.
require_once("../../conecta.php");

//receber os dados do formulário.
$descricao = $_POST['descricao'];
$horario = $_POST['horario'];
$data = $_POST['data_'];
$nome = $_POST['nome'];

//comando sql.
$sql = "INSERT INTO encontro (descricao, horario, data_, nome) 
VALUES ('$descricao','$horario','$data','$nome')";
mysqli_query($conexao, $sql);
header("location: listar.php");

?>