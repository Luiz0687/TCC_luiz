<?php

// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();
// receber os dados do formulário
$id_encontro = $_GET['id_encontro'];
$descricao = $_GET['descricao'];
$horario = $_GET['horario'];
$data = $_GET['data'];
$nome_encontro = $_GET['nome_encontro'];


$sql = "UPDATE encontro SET descricao = '$descricao', horario = '$horario', data = '$data', nome_encontro = '$nome_encontro' WHERE id_encontro = '$id_encontro'";

mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar encontro no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>