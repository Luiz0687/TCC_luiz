<?php

// Conectar ao BD
require_once("../conecta.php");

// receber os dados do formulário
$id_usuario = $_GET['id_usuario'];
$nome= $_GET['nome'];
$email = $_GET['email'];
$senha = $_GET['senha'];
$usuario_tipo = $_GET['usuario_tipo'];


$sql = "UPDATE usuario SET 
nome = '$nome', email = '$email', senha = '$senha', usuario_tipo = $usuario_tipo WHERE id_usuario = $id_usuario";
mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar usuário no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>