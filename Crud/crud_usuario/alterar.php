<?php

// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();

// receber os dados do formulário


$id_usuario = $_GET['id_usuario'];
$nome= $_GET['nome'];
$email = $_GET['email'];
$usuario_tipo = $_GET['usuario_tipo'];


$sql = "UPDATE usuario SET 
nome = '$nome', email = '$email', usuario_tipo = $usuario_tipo WHERE id_usuario = $id_usuario";
mysqli_query($conexao,$sql);

if ($conexao->error) {

    die("Falha ao editar usuário no sistema:". $conexao->error);

}else {
    header("location: listar.php");
}
// executa o comando no BD

?>