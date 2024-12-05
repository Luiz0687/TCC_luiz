<?php

// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();
// receber os dados do formulário

$codSemana= $_GET['cod_semana'];
$hora = $_GET['hora'];
$id_projeto = $_POST['fk_projeto_id_projeto'];

$sql = "UPDATE horario SET cod_semana = '$codSemana', hora = '$hora' WHERE id_horario = '$id_horario' INNER JOIN projeto WHERE fk_projeto_id_projeto = '$id_projeto'";

mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar horario no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>