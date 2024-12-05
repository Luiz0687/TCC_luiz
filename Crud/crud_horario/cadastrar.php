<?php

//conectar ao banco de dados.
require_once("../../conecta.php");

//receber os dados do formulário.
$codSemana = $_POST['cod_semana'];
$hora = $_POST['hora'];

$idProjeto = $_POST['fk_projeto_id_projeto'];


//comando sql.
$sql = "INSERT INTO horario (cod_semana, hora, fk_projeto_id_projeto) VALUES ($codSemana, '$hora', $idProjeto)";



mysqli_query($conexao, $sql);
header("location: listar.php");

?>