<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION)){
    echo " <script>alert('Você não está logado no sistema!');
    window.location.href=window.location.origin +'/TCC/index.php';
    </script>";
      die;
 }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Página do aluno</h1>
    
    <h2><?php
    echo "Olá" . " " .$_SESSION['nome'] ;
    ?></h2>
     <a href="listarProjeto.php">Projetos disponiveis</a><br><br>
     <a href="listarProjeto.php">Minhas inscrições</a><br><br>
     <a href="listarProjeto.php">Minhas frequências</a><br><br>
    <a href="../../index.php">Sair</a>
</body>
</html>