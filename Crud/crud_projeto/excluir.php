
<?php
require_once("../../conecta.php");
$conexao = conectar();

$id_projeto = $_GET['id_projeto'];

// Primeiro, excluir as associações na tabela usuario_projeto
$sql_usuario_projeto = "DELETE FROM usuario_projeto WHERE fk_projeto_id_projeto = $id_projeto";
mysqli_query($conexao, $sql_usuario_projeto);

// Agora, excluir o projeto da tabela projeto
$sql_projeto = "DELETE FROM projeto WHERE id_projeto = $id_projeto";
mysqli_query($conexao, $sql_projeto);

// Redirecionar de volta para a página de lista de projetos
header("Location: ../../Login/professor/professor.php");
exit();
?>
