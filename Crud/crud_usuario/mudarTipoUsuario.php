<?php
require_once("../../conecta.php");
$conexao = conectar();

$id_usuario = $_GET['id_usuario'];

$sql = "UPDATE usuario a SET a.usuario_tipo = 2 WHERE a.id_usuario = $id_usuario";
executarSQL($conexao, $sql);

header("location:designar.php")


?> 