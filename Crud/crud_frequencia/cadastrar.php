<?php

//conectar ao banco de dados.
require_once("../conecta.php");

//receber os dados do formulário.
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$usuario_tipo = $_POST['usuario_tipo'];
//comando sql.
$sql = "INSERT INTO usuario (nome, email, senha, usuario_tipo) 
VALUES ('$nome', '$email', '$senha' , $usuario_tipo)";
mysqli_query($conexao, $sql);
header("location: listar.php");

?>