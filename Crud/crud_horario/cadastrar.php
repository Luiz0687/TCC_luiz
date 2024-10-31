<?php

//conectar ao banco de dados.
require_once("../../conecta.php");

//receber os dados do formulário.
$data = $_POST['data_'];
$horario = $_POST['horario'];
//comando sql.
$sql = "INSERT INTO horario (data_, horario) 
VALUES ('$data', '$horario')";
mysqli_query($conexao, $sql);
header("location: listar.php");

?>