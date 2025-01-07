<?php

// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();

// receber os dados do formulário
$id_projeto = $_POST['id_projeto'];
$nome= $_POST['nome_projeto'];
$situacao= $_POST['situacao'];

$sql = "UPDATE projeto SET 
nome_projeto = '$nome', situacao = '$situacao' WHERE id_projeto = $id_projeto";
mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar usuário no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>