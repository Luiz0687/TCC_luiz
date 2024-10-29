<?php

//conectar ao banco de dados.
require_once("../conecta.php");

//receber os dados do formulário.
$data = $_POST['data'];
$horaInicio = $_POST['horaInicio'];
$horaFinal = $_POST['horaFinal'];
//comando sql.
$sql = "INSERT INTO horario ('data', horaInicio, horaFinal) 
VALUES ('$data', '$horaInicio', '$horaFinal')";
mysqli_query($conexao, $sql);
header("location: listar.php");

?>