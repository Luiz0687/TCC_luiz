<?php
require_once "../../conecta.php";
$conexao = conectar();
include_once("../../notificacao/funcaoNotificacao.php");

$id_usuario  = $_SESSION['usuario'][1];
//receber o id do projeto
$id_projeto = $_GET['id_projeto'];
$sql = "INSERT INTO usuario_projeto (fk_usuario_id_usuario, fk_projeto_id_projeto) VALUES ($id_usuario, $id_projeto)";
$execucao = executarSQL($conexao, $sql);
header("location: aluno.php");
