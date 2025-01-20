<?php
include_once "../../notificacao/funcaoNotificacao.php";
include_once "../../conecta.php";
$conexao = conectar();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno</title>
</head>
<body>
    <h1>Página do aluno</h1>
 
    <h2>
        <?php
    echo "Olá" . " " . $_SESSION['usuario'][0];
    ?></h2>
     <a href="listarProjeto.php">Projetos disponiveis</a><br><br>
     <a href="minhaInscricoes.php">Minhas inscrições</a><br><br>
     <a href="listarProjeto.php">Minhas frequências</a><br><br>
    <a href="../../index.php">Sair</a>
</body>
</html>