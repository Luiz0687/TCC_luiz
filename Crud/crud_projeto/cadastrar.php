<?php

//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

//receber os dados do formulário.
$nome = $_POST['nome_projeto'];
$situacao = $_POST['situacao'];
$id_professor = $_POST['id_professor'];

//comando sql.
$sql = "INSERT INTO projeto (nome_projeto, situacao, fk_projeto_id_professor) 
VALUES ('$nome', '$situacao', $id_professor)";
mysqli_query($conexao, $sql);
header("location: ../../Login/professor/professor.php");

?>