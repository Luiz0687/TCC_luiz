<?php
require_once("../../notificacao/funcaoNotificacao.php");
require_once("../../conecta.php");
$conexao = conectar();

// Pegando o ID do encontro a ser excluído
$id_encontro = $_GET['id_encontro'];

// Agora, vamos pegar o id_projeto relacionado a esse encontro
$sql_projeto = "SELECT fk_id_projeto FROM encontro WHERE id_encontro = $id_encontro";
$resultado_projeto = mysqli_query($conexao, $sql_projeto);

// Verifica se o encontro existe e pega o id_projeto
if ($resultado_projeto) {
    $dados_projeto = mysqli_fetch_assoc($resultado_projeto);
    $id_projeto = $dados_projeto['fk_id_projeto'];
} else {
    die('Encontro não encontrado.');
}

// Exclui as frequências associadas ao encontro
$sql_frequencia = "DELETE FROM frequencia WHERE fk_id_encontro = $id_encontro";
mysqli_query($conexao, $sql_frequencia);

// Exclui o encontro
$sql_encontro = "DELETE FROM encontro WHERE id_encontro = $id_encontro";
mysqli_query($conexao, $sql_encontro);

// Redirecionar de volta para a página de encontros, passando o id_projeto corretamente
header("Location: listarEncontro.php?id_projeto=$id_projeto");
exit();
?>
