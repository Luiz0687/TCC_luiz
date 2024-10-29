<?php

// Conectar ao BD
require_once("../conecta.php");

// receber os dados do formulário
$id_horario = $_GET['id_horario'];
$data = $_GET['data'];
$horaInicio = $_GET['horaInicio'];
$horaFinal = $_GET['horaFinal'];

$sql = "UPDATE horario SET 
data = '$data', horaInicio = $horaInicio, horaFinal = $horaFinal WHERE id_horario = $id_horario";
mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar horario no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>