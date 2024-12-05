<?php

// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();
// receber os dados do formulário
$id_horario = $_GET['id_horario'];
$codSemana= $_GET['cod_semana'];
$hora = $_GET['hora'];

$sql = "UPDATE horario SET cod_semana = '$codSemana', hora = '$hora' WHERE id_horario = '$id_horario'";

mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar horario no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>