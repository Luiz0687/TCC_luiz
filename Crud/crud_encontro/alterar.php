<?php

// Conectar ao BD
require_once("../../conecta.php");
// receber os dados do formulário
$id_encontro = $_GET['id_encontro'];
$descricao = $_GET['descricao'];
$horario = $_GET['horario'];
$data = $_GET['data_'];
$nome = $_GET['nome'];


$sql = "UPDATE encontro SET descricao = '$descricao', horario = '$horario', data_ = '$data', nome = '$nome' WHERE id_encontro = '$id_encontro'";

mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar encontro no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>