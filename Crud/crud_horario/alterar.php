<?php

// Conectar ao BD
require_once("../../conecta.php");
// receber os dados do formulário
$id_horario = $_GET['id_horario'];
$data = $_GET['data_'];
$horario = $_GET['horario'];

$sql = "UPDATE horario SET data_ = '$data', horario = '$horario' WHERE id_horario = '$id_horario'";

mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar horario no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>