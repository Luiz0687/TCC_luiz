<?php

//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

//receber os dados do formulário.
$horario = $_POST['horario'];
$data = $_POST['data'];
$id_projeto = $_POST['id_projeto'];

//comando sql.
$sql = "INSERT INTO encontro (horario, data, fk_id_projeto) 
VALUES ('$horario','$data', $id_projeto)";

mysqli_query($conexao, $sql);
header("location: listar.php?id_projeto=$id_projeto");

?>