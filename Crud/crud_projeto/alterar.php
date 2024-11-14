<?php

// Conectar ao BD
require_once("../conecta.php");

// receber os dados do formulário
$id_projeto = $_GET['id_projeto'];
$nome= $_GET['nome'];

var_dump($id_projeto);

$sql = "UPDATE projeto SET 
nome = '$nome' WHERE id_projeto = $id_projeto";
mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar usuário no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>