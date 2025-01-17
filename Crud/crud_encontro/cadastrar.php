<?php

//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

//receber os dados do formulário.
$CH = $_POST['CH'];
$data = $_POST['data'];
$id_projeto = $_POST['id_projeto'];

//comando sql.
$sql = "INSERT INTO encontro (CH, data, fk_id_projeto) 
VALUES ('$CH','$data', $id_projeto)";

mysqli_query($conexao, $sql);
header("location: listar.php?id_projeto=$id_projeto");

?>