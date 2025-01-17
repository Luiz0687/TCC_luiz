<?php

// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();
// receber os dados do formulário
$id_encontro = $_GET['id_encontro'];
$CH = $_GET['CH'];
$data = $_GET['data'];


$sql = "UPDATE encontro SET CH = '$CH', data = '$data', WHERE id_encontro = '$id_encontro'";

mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar encontro no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>